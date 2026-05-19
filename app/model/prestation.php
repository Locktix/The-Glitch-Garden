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
    private int $categorieId;
    private string $artiste;
    private int $artisteId;
    private string $horaire;
    private string $scene;
    private string $image;

    public function __construct(
        ?int $id = null,
        string $titre = '',
        string $description = '',
        string $categorie = '',
        string $artiste = '',
        int $artisteId = 0,
        string $horaire = '',
        string $scene = '',
        string $image = '',
        int $categorieId = 0
    ) {
        $this->id          = $id ?? 0;
        $this->titre       = $titre;
        $this->description = $description;
        $this->categorie   = $categorie;
        $this->categorieId = $categorieId;
        $this->artiste     = $artiste;
        $this->artisteId   = $artisteId;
        $this->horaire     = $horaire;
        $this->scene       = $scene;
        $this->image       = $image;
    }

    public function getId(): int          { return $this->id; }
    public function getTitre(): string    { return $this->titre; }
    public function getDescription(): string { return $this->description; }
    public function getCategorie(): string    { return $this->categorie; }
    public function getCategorieId(): int     { return $this->categorieId; }
    public function getArtiste(): string  { return $this->artiste; }
    public function getArtisteId(): int   { return $this->artisteId; }
    public function getHoraire(): string  { return $this->horaire; }
    public function getScene(): string    { return $this->scene; }
    public function getImage(): string    { return $this->image; }

    public function setTitre(string $titre): void          { $this->titre = $titre; }
    public function setDescription(string $desc): void     { $this->description = $desc; }
    public function setCategorieId(int $categorieId): void { $this->categorieId = $categorieId; }

    public function create(): int
    {
        $pdo = Database::getPDO();
        $req = $pdo->prepare("
            INSERT INTO prestations (titre, description, categorie_id, artiste_id)
            VALUES (:titre, :description, :categorie_id, :artiste_id)
        ");
        $req->bindValue(':titre',        $this->titre,      PDO::PARAM_STR);
        $req->bindValue(':description',  $this->description, PDO::PARAM_STR);
        $req->bindValue(':categorie_id', $this->categorieId, PDO::PARAM_INT);
        $req->bindValue(':artiste_id',   $this->artisteId,   PDO::PARAM_INT);
        $req->execute();
        $this->id = (int) $pdo->lastInsertId();
        return $this->id;
    }

    public function update(): bool
    {
        $pdo = Database::getPDO();
        $req = $pdo->prepare("
            UPDATE prestations
            SET titre = :titre, description = :description, categorie_id = :categorie_id
            WHERE id = :id
        ");
        $req->bindValue(':id',           $this->id,          PDO::PARAM_INT);
        $req->bindValue(':titre',        $this->titre,       PDO::PARAM_STR);
        $req->bindValue(':description',  $this->description, PDO::PARAM_STR);
        $req->bindValue(':categorie_id', $this->categorieId, PDO::PARAM_INT);
        $req->execute();
        return $req->rowCount() > 0;
    }

    public function delete(): bool
    {
        $pdo = Database::getPDO();
        $req = $pdo->prepare("DELETE FROM prestations WHERE id = :id");
        $req->bindValue(':id', $this->id, PDO::PARAM_INT);
        $req->execute();
        return $req->rowCount() > 0;
    }

    public function toPlan(int $sceneId, string $heureDebut): bool
    {
        $pdo = Database::getPDO();
        $req = $pdo->prepare("
            INSERT INTO programmation (prestation_id, scene_id, heure_debut)
            VALUES (:prestation_id, :scene_id, :heure_debut)
        ");
        $req->bindValue(':prestation_id', $this->id,    PDO::PARAM_INT);
        $req->bindValue(':scene_id',      $sceneId,     PDO::PARAM_INT);
        $req->bindValue(':heure_debut',   $heureDebut,  PDO::PARAM_STR);
        $req->execute();
        return $req->rowCount() > 0;
    }

    public function unplan(int $programmationId): bool
    {
        $pdo = Database::getPDO();
        $req = $pdo->prepare("DELETE FROM programmation WHERE id = :id");
        $req->bindValue(':id', $programmationId, PDO::PARAM_INT);
        $req->execute();
        return $req->rowCount() > 0;
    }

    public function isProgrammed(): bool
    {
        $pdo = Database::getPDO();
        $req = $pdo->prepare("SELECT id FROM programmation WHERE prestation_id = :id");
        $req->bindValue(':id', $this->id, PDO::PARAM_INT);
        $req->execute();
        return (bool) $req->fetch();
    }

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
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
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
        $req->bindValue(':id', $artisteId, PDO::PARAM_INT);
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
                $row['horaire'],
                $row['scene'],
                $row['image'] ?? ''
            );
        }

        return $prestations;
    }
}
