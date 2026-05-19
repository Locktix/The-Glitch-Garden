<?php

namespace app\model;

require_once __DIR__ . '/../database/database.php';

use App\Database\Database;
use PDO;

class Utilisateur
{
    private int $id;
    private string $nom;
    private string $prenom;
    private string $email;
    private string $description;
    private string $nomArtiste;
    private bool $estOrganisateur;

    public function __construct(
        ?int $id = null,
        string $nom = '',
        string $prenom = '',
        string $email = '',
        string $description = '',
        string $nomArtiste = '',
        bool $estOrganisateur = false
    ) {
        $this->id              = $id ?? 0;
        $this->nom             = $nom;
        $this->prenom          = $prenom;
        $this->email           = $email;
        $this->description     = $description;
        $this->nomArtiste      = $nomArtiste;
        $this->estOrganisateur = $estOrganisateur;
    }

    public function getId(): int               { return $this->id; }
    public function getNom(): string           { return $this->nom; }
    public function getPrenom(): string        { return $this->prenom; }
    public function getEmail(): string         { return $this->email; }
    public function getDescription(): string   { return $this->description; }
    public function getNomArtiste(): string     { return $this->nomArtiste; }
    public function estOrganisateur(): bool    { return $this->estOrganisateur; }

    public function setNom(string $nom): void               { $this->nom = $nom; }
    public function setPrenom(string $prenom): void         { $this->prenom = $prenom; }
    public function setEmail(string $email): void           { $this->email = $email; }
    public function setDescription(string $desc): void      { $this->description = $desc; }
    public function setNomArtiste(string $nomArtiste): void { $this->nomArtiste = $nomArtiste; }

    public function update(?string $motDePasse = null): bool
    {
        $pdo = Database::getPDO();
        if ($motDePasse !== null && $motDePasse !== '') {
            $req = $pdo->prepare("
                UPDATE utilisateurs
                SET nom = :nom, prenom = :prenom, email = :email, description = :desc, nom_artiste = :na, mot_de_passe = :mdp
                WHERE id = :id
            ");
            $req->bindValue(':mdp', $motDePasse, PDO::PARAM_STR);
        } else {
            $req = $pdo->prepare("
                UPDATE utilisateurs
                SET nom = :nom, prenom = :prenom, email = :email, description = :desc, nom_artiste = :na
                WHERE id = :id
            ");
        }
        $req->bindValue(':id',     $this->id,                           PDO::PARAM_INT);
        $req->bindValue(':nom',    $this->nom,                          PDO::PARAM_STR);
        $req->bindValue(':prenom', $this->prenom,                       PDO::PARAM_STR);
        $req->bindValue(':email',  $this->email,                        PDO::PARAM_STR);
        $req->bindValue(':desc',   $this->description,                  PDO::PARAM_STR);
        $req->bindValue(':na',     $this->nomArtiste ?: null,           PDO::PARAM_STR);
        $req->execute();
        return $req->rowCount() > 0;
    }

    public function create(string $motDePasse): int
    {
        $pdo = Database::getPDO();
        $req = $pdo->prepare("
            INSERT INTO utilisateurs (nom, prenom, nom_artiste, description, email, mot_de_passe, est_organisateur)
            VALUES (:nom, :prenom, :na, :desc, :email, :mdp, FALSE)
        ");
        $req->bindValue(':nom',    $this->nom,          PDO::PARAM_STR);
        $req->bindValue(':prenom', $this->prenom,       PDO::PARAM_STR);
        $req->bindValue(':na',     $this->nomArtiste,   PDO::PARAM_STR);
        $req->bindValue(':desc',   $this->description,  PDO::PARAM_STR);
        $req->bindValue(':email',  $this->email,        PDO::PARAM_STR);
        $req->bindValue(':mdp',    $motDePasse,         PDO::PARAM_STR);
        $req->execute();
        $this->id = (int) $pdo->lastInsertId();
        return $this->id;
    }

    public static function emailExiste(string $email, ?int $excluId = null): bool
    {
        $pdo = Database::getPDO();
        if ($excluId !== null) {
            $req = $pdo->prepare("SELECT id FROM utilisateurs WHERE email = :email AND id != :id");
            $req->bindValue(':id', $excluId, PDO::PARAM_INT);
        } else {
            $req = $pdo->prepare("SELECT id FROM utilisateurs WHERE email = :email");
        }
        $req->bindValue(':email', $email, PDO::PARAM_STR);
        $req->execute();
        return (bool) $req->fetch();
    }

    public static function getById(int $id): ?Utilisateur
    {
        $pdo = Database::getPDO();
        $req = $pdo->prepare("SELECT * FROM utilisateurs WHERE id = :id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        $row = $req->fetch(PDO::FETCH_ASSOC);

        if (!$row) return null;

        return new Utilisateur(
            (int)$row['id'],
            $row['nom'],
            $row['prenom'],
            $row['email'],
            $row['description'] ?? '',
            $row['nom_artiste'] ?? '',
            (bool)$row['est_organisateur']
        );
    }

    public static function getByIdArtiste(int $id): ?Utilisateur
    {
        $pdo = Database::getPDO();
        $req = $pdo->prepare("SELECT * FROM utilisateurs WHERE id = :id AND est_organisateur = FALSE");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        $row = $req->fetch(PDO::FETCH_ASSOC);

        if (!$row) return null;

        return new Utilisateur(
            (int)$row['id'],
            $row['nom'],
            $row['prenom'],
            $row['email'],
            $row['description'] ?? '',
            $row['nom_artiste'] ?? '',
            false
        );
    }

    public static function getAll(): array
    {
        $pdo = Database::getPDO();
        $req = $pdo->prepare("SELECT * FROM utilisateurs WHERE est_organisateur = FALSE ORDER BY nom_artiste");
        $req->execute();
        $rows = $req->fetchAll(PDO::FETCH_ASSOC);

        $utilisateurs = [];
        foreach ($rows as $row) {
            $utilisateurs[] = new Utilisateur(
                (int)$row['id'],
                $row['nom'],
                $row['prenom'],
                $row['email'],
                $row['description'] ?? '',
                $row['nom_artiste'] ?? '',
                false
            );
        }
        return $utilisateurs;
    }
}
