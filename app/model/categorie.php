<?php

namespace app\model;

require_once __DIR__ . '/../database/database.php';

use App\Database\Database;
use PDO;

class Categorie
{
    private int $id;
    private string $nom;

    public function __construct(int $id, string $nom)
    {
        $this->id  = $id;
        $this->nom = $nom;
    }

    public function getId(): int     { return $this->id; }
    public function getNom(): string { return $this->nom; }

    public static function getAll(): array
    {
        $pdo = Database::getPDO();
        $req = $pdo->prepare("SELECT id, nom FROM categories ORDER BY nom");
        $req->execute();
        $rows = $req->fetchAll(PDO::FETCH_ASSOC);

        $categories = [];
        foreach ($rows as $row) {
            $categories[] = new Categorie((int)$row['id'], $row['nom']);
        }
        return $categories;
    }
}
