<?php

namespace app\model;

require_once __DIR__ . '/../database/database.php';

use App\Database\Database;
use PDO;

class Programmation
{
    public static function getGrille(): array
    {
        $pdo = Database::getPDO();
        $req = $pdo->prepare("
            SELECT
                pr.id                                AS programmation_id,
                TIME_FORMAT(pr.heure_debut, '%Hh%i') AS heure,
                s.nom                                AS scene,
                p.id                                 AS prestation_id,
                p.titre,
                u.nom_artiste                        AS artiste
            FROM programmation pr
            JOIN prestations p  ON p.id = pr.prestation_id
            JOIN scenes s       ON s.id = pr.scene_id
            JOIN utilisateurs u ON u.id = p.artiste_id
            ORDER BY pr.heure_debut ASC
        ");
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getByArtisteId(int $artisteId): array
    {
        $pdo = Database::getPDO();
        $req = $pdo->prepare("
            SELECT p.id, p.titre, TIME_FORMAT(pr.heure_debut, '%Hh%i') AS heure, s.nom AS scene
            FROM prestations p
            JOIN programmation pr ON pr.prestation_id = p.id
            JOIN scenes s         ON s.id = pr.scene_id
            WHERE p.artiste_id = :id
            ORDER BY pr.heure_debut ASC
        ");
        $req->bindValue(':id', $artisteId, PDO::PARAM_INT);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getCatalogueArtiste(int $artisteId): array
    {
        $pdo = Database::getPDO();
        $req = $pdo->prepare("
            SELECT p.id, p.titre, c.nom AS categorie,
                   CASE WHEN pr.id IS NOT NULL THEN 1 ELSE 0 END AS est_programmee
            FROM prestations p
            JOIN categories c ON c.id = p.categorie_id
            LEFT JOIN programmation pr ON pr.prestation_id = p.id
            WHERE p.artiste_id = :id
            ORDER BY p.titre ASC
        ");
        $req->bindValue(':id', $artisteId, PDO::PARAM_INT);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
}
