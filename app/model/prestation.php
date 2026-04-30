<?php

namespace app\model;

require_once __DIR__ . '/../database/database.php';

use App\Database\Database;
use PDO;

class Prestation
{
    private int $id;
    private string $titre;
    private string $description;
    private string $categorie;
    private string $artiste;
    private int $artisteId;
    private string $horaire;
    private string $scene;
    private string $image;

    public function __construct(int $id, string $titre, string $description, string $categorie, string $artiste, int $artisteId, string $horaire, string $scene, string $image)
    {
        $this->id = $id;
        $this->titre = $titre;
        $this->description = $description;
        $this->categorie = $categorie;
        $this->artiste = $artiste;
        $this->artisteId = $artisteId;
        $this->horaire = $horaire;
        $this->scene = $scene;
        $this->image = $image;
    }

    public function getId(): int { return $this->id; }
    public function getTitre(): string { return $this->titre; }
    public function getDescription(): string { return $this->description; }
    public function getCategorie(): string { return $this->categorie; }
    public function getArtiste(): string { return $this->artiste; }
    public function getArtisteId(): int { return $this->artisteId; }
    public function getHoraire(): string { return $this->horaire; }
    public function getScene(): string { return $this->scene; }
    public function getImage(): string { return $this->image; }

    public static function getAll(): array
    {
        $pdo = Database::getPDO();
        $req = $pdo->prepare("
            SELECT
                p.id,
                p.titre,
                p.description,
                p.image,
                c.nom                                AS categorie,
                u.nom_artiste                        AS artiste,
                u.id                                 AS artiste_id,
                TIME_FORMAT(pr.heure_debut, '%Hh%i') AS horaire,
                COALESCE(s.nom, '')                  AS scene
            FROM prestations p
            JOIN categories c   ON c.id = p.categorie_id
            JOIN utilisateurs u ON u.id = p.artiste_id
            LEFT JOIN programmation pr ON pr.prestation_id = p.id
            LEFT JOIN scenes s  ON s.id = pr.scene_id
            ORDER BY pr.heure_debut ASC
        ");
        $req->execute();
        $rows = $req->fetchAll(PDO::FETCH_ASSOC);

        $prestations = [];
        foreach ($rows as $row) {
            $prestations[] = new Prestation(
                (int)$row['id'],
                $row['titre'],
                $row['description'] ?? '',
                $row['categorie'],
                $row['artiste'],
                (int)$row['artiste_id'],
                $row['horaire'] ?? 'Non programmée',
                $row['scene'],
                $row['image'] ?? ''
            );
        }

        return $prestations;
    }

    public static function getById(int $id): ?Prestation
    {
        $pdo = Database::getPDO();
        $req = $pdo->prepare("
            SELECT
                p.id,
                p.titre,
                p.description,
                p.image,
                c.nom                                AS categorie,
                u.nom_artiste                        AS artiste,
                u.id                                 AS artiste_id,
                TIME_FORMAT(pr.heure_debut, '%Hh%i') AS horaire,
                COALESCE(s.nom, '')                  AS scene
            FROM prestations p
            JOIN categories c   ON c.id = p.categorie_id
            JOIN utilisateurs u ON u.id = p.artiste_id
            LEFT JOIN programmation pr ON pr.prestation_id = p.id
            LEFT JOIN scenes s  ON s.id = pr.scene_id
            WHERE p.id = :id
        ");
        $req->execute([':id' => $id]);
        $row = $req->fetch(PDO::FETCH_ASSOC);

        if (!$row) return null;

        return new Prestation(
            (int)$row['id'],
            $row['titre'],
            $row['description'] ?? '',
            $row['categorie'],
            $row['artiste'],
            (int)$row['artiste_id'],
            $row['horaire'] ?? 'Non programmée',
            $row['scene'],
            $row['image'] ?? ''
        );
    }

    public static function getByArtisteId(int $artisteId): array
    {
        $pdo = Database::getPDO();
        $req = $pdo->prepare("
            SELECT
                p.id,
                p.titre,
                p.description,
                p.image,
                c.nom                                AS categorie,
                u.nom_artiste                        AS artiste,
                u.id                                 AS artiste_id,
                TIME_FORMAT(pr.heure_debut, '%Hh%i') AS horaire,
                COALESCE(s.nom, '')                  AS scene
            FROM prestations p
            JOIN categories c        ON c.id = p.categorie_id
            JOIN utilisateurs u      ON u.id = p.artiste_id
            LEFT JOIN programmation pr ON pr.prestation_id = p.id
            LEFT JOIN scenes s         ON s.id = pr.scene_id
            WHERE p.artiste_id = :id
            ORDER BY pr.heure_debut ASC
        ");
        $req->execute([':id' => $artisteId]);
        $rows = $req->fetchAll(PDO::FETCH_ASSOC);

        $prestations = [];
        foreach ($rows as $row) {
            $prestations[] = new Prestation(
                (int)$row['id'],
                $row['titre'],
                $row['description'] ?? '',
                $row['categorie'],
                $row['artiste'],
                (int)$row['artiste_id'],
                $row['horaire'],
                $row['scene'],
                $row['image'] ?? ''
            );
        }

        return $prestations;
    }
}
