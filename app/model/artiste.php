<?php

namespace app\model;

require_once __DIR__ . '/../database/database.php';

use App\Database\Database;
use PDO;

class Artiste
{
    private int $id;
    private string $nom;
    private string $nomReel;
    private string $bio;
    private string $image;
    private array $styles;
    private array $programmation;

    public function __construct(int $id, string $nom, string $nomReel, string $bio, string $image, array $styles, array $programmation)
    {
        $this->id            = $id;
        $this->nom           = $nom;
        $this->nomReel       = $nomReel;
        $this->bio           = $bio;
        $this->image         = $image;
        $this->styles        = $styles;
        $this->programmation = $programmation;
    }

    public function getId(): int            { return $this->id; }
    public function getNom(): string        { return $this->nom; }
    public function getNomReel(): string    { return $this->nomReel; }
    public function getBio(): string        { return $this->bio; }
    public function getImage(): string      { return $this->image; }
    public function getStyles(): array      { return $this->styles; }
    public function getProgrammation(): array { return $this->programmation; }

    public static function getAll(): array
    {
        $pdo = Database::getPDO();

        $req = $pdo->prepare("
            SELECT id, nom_artiste, nom, prenom, description, photo
            FROM utilisateurs
            WHERE est_organisateur = FALSE
        ");
        $req->execute();
        $rows = $req->fetchAll(PDO::FETCH_ASSOC);

        $artistes = [];

        foreach ($rows as $row) {
            $reqStyles = $pdo->prepare("
                SELECT DISTINCT c.nom
                FROM prestations p
                JOIN categories c ON c.id = p.categorie_id
                WHERE p.artiste_id = :id
            ");
            $reqStyles->execute([':id' => $row['id']]);
            $styles = $reqStyles->fetchAll(PDO::FETCH_COLUMN);

            $reqProg = $pdo->prepare("
                SELECT CONCAT(pr.heure_debut, ' - ', p.titre, ' - ', s.nom) AS ligne
                FROM prestations p
                JOIN programmation pr ON pr.prestation_id = p.id
                JOIN scenes s ON s.id = pr.scene_id
                WHERE p.artiste_id = :id
            ");
            $reqProg->execute([':id' => $row['id']]);
            $programmation = $reqProg->fetchAll(PDO::FETCH_COLUMN);

            $artistes[] = new Artiste(
                (int)$row['id'],
                $row['nom_artiste'] ?? '',
                $row['prenom'] . ' ' . $row['nom'],
                $row['description'] ?? '',
                $row['photo'] ?? '',
                $styles,
                $programmation
            );
        }

        return $artistes;
    }

    public static function getById(int $id): ?Artiste
    {
        $pdo = Database::getPDO();

        $req = $pdo->prepare("
            SELECT id, nom_artiste, nom, prenom, description, photo
            FROM utilisateurs
            WHERE id = :id AND est_organisateur = FALSE
        ");
        $req->execute([':id' => $id]);
        $row = $req->fetch(PDO::FETCH_ASSOC);

        if (!$row) return null;

        $reqStyles = $pdo->prepare("
            SELECT DISTINCT c.nom
            FROM prestations p
            JOIN categories c ON c.id = p.categorie_id
            WHERE p.artiste_id = :id
        ");
        $reqStyles->execute([':id' => $id]);
        $styles = $reqStyles->fetchAll(PDO::FETCH_COLUMN);

        $reqProg = $pdo->prepare("
            SELECT CONCAT(pr.heure_debut, ' - ', p.titre, ' - ', s.nom) AS ligne
            FROM prestations p
            JOIN programmation pr ON pr.prestation_id = p.id
            JOIN scenes s ON s.id = pr.scene_id
            WHERE p.artiste_id = :id
        ");
        $reqProg->execute([':id' => $id]);
        $programmation = $reqProg->fetchAll(PDO::FETCH_COLUMN);

        return new Artiste(
            (int)$row['id'],
            $row['nom_artiste'] ?? '',
            $row['prenom'] . ' ' . $row['nom'],
            $row['description'] ?? '',
            $row['photo'] ?? '',
            $styles,
            $programmation
        );
    }
}
