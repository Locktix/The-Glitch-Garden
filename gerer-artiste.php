<?php
require_once 'app/database/database.php';
use App\Database\Database;

$pdo     = Database::getPDO();
$erreurs = [];
$succes  = '';

$artisteId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$req = $pdo->prepare("SELECT * FROM utilisateurs WHERE id = :id AND est_organisateur = FALSE");
$req->execute([':id' => $artisteId]);
$artiste = $req->fetch(PDO::FETCH_ASSOC);

if (!$artiste) {
    header('Location: gerer-artistes.php');
    exit;
}

// Traitement du formulaire profil
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom        = trim($_POST['nom'] ?? '');
    $prenom     = trim($_POST['prenom'] ?? '');
    $email      = trim($_POST['email'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $nomArtiste = trim($_POST['nom_artiste'] ?? '');
    $mdp        = $_POST['mot_de_passe'] ?? '';
    $mdpConfirm = $_POST['mot_de_passe_confirm'] ?? '';

    if ($nom === '')    $erreurs['nom']    = 'Le nom est obligatoire.';
    if ($prenom === '') $erreurs['prenom'] = 'Le prénom est obligatoire.';

    if ($email === '') {
        $erreurs['email'] = "L'e-mail est obligatoire.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreurs['email'] = "Format d'e-mail invalide.";
    } else {
        $check = $pdo->prepare("SELECT id FROM utilisateurs WHERE email = :email AND id != :id");
        $check->execute([':email' => $email, ':id' => $artisteId]);
        if ($check->fetch()) {
            $erreurs['email'] = "Cet e-mail est déjà utilisé.";
        }
    }

    if ($mdp !== '' && $mdp !== $mdpConfirm) {
        $erreurs['mot_de_passe_confirm'] = "Les mots de passe ne correspondent pas.";
    }

    if (empty($erreurs)) {
        if ($mdp !== '') {
            $upd = $pdo->prepare("UPDATE utilisateurs SET nom = :nom, prenom = :prenom, email = :email, description = :desc, nom_artiste = :na, mot_de_passe = :mdp WHERE id = :id");
            $upd->execute([':nom' => $nom, ':prenom' => $prenom, ':email' => $email, ':desc' => $description, ':na' => $nomArtiste ?: null, ':mdp' => $mdp, ':id' => $artisteId]);
        } else {
            $upd = $pdo->prepare("UPDATE utilisateurs SET nom = :nom, prenom = :prenom, email = :email, description = :desc, nom_artiste = :na WHERE id = :id");
            $upd->execute([':nom' => $nom, ':prenom' => $prenom, ':email' => $email, ':desc' => $description, ':na' => $nomArtiste ?: null, ':id' => $artisteId]);
        }
        $succes = "Profil mis à jour avec succès.";
        $req->execute([':id' => $artisteId]);
        $artiste = $req->fetch(PDO::FETCH_ASSOC);
    } else {
        $artiste['nom']         = $nom;
        $artiste['prenom']      = $prenom;
        $artiste['email']       = $email;
        $artiste['description'] = $description;
        $artiste['nom_artiste'] = $nomArtiste;
    }
}

// Récupérer le catalogue de l'artiste
$reqCatalogue = $pdo->prepare("
    SELECT p.id, p.titre, c.nom AS categorie,
           CASE WHEN pr.id IS NOT NULL THEN 1 ELSE 0 END AS est_programmee
    FROM prestations p
    JOIN categories c ON c.id = p.categorie_id
    LEFT JOIN programmation pr ON pr.prestation_id = p.id
    WHERE p.artiste_id = :id
    ORDER BY p.titre ASC
");
$reqCatalogue->execute([':id' => $artisteId]);
$prestations = $reqCatalogue->fetchAll(PDO::FETCH_ASSOC);

$succes = $succes ?: (isset($_GET['succes']) ? $_GET['succes'] : '');

$page = 'gerer-artiste';
include 'app/view/header.php';
?>

<a href="gerer-artistes.php" class="back-link">&larr; Retour à la liste des artistes</a>
<h1 class="page-title">Gérer : <?php echo htmlspecialchars($artiste['nom_artiste'] ?? $artiste['prenom'] . ' ' . $artiste['nom']); ?></h1>

<?php if ($succes): ?>
    <div class="succes-message"><?php echo htmlspecialchars($succes); ?></div>
<?php endif; ?>

<section class="program-section">
    <h2 class="section-title">Profil de l'artiste</h2>

    <form method="POST" action="gerer-artiste.php?id=<?php echo $artisteId; ?>">

        <div class="form-group">
            <label for="prenom">Prénom *</label>
            <input type="text" id="prenom" name="prenom" value="<?php echo htmlspecialchars($artiste['prenom']); ?>" <?php echo isset($erreurs['prenom']) ? 'class="input-error"' : ''; ?>>
            <?php if (isset($erreurs['prenom'])): ?><span class="field-error"><?php echo $erreurs['prenom']; ?></span><?php endif; ?>
        </div>

        <div class="form-group">
            <label for="nom">Nom *</label>
            <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($artiste['nom']); ?>" <?php echo isset($erreurs['nom']) ? 'class="input-error"' : ''; ?>>
            <?php if (isset($erreurs['nom'])): ?><span class="field-error"><?php echo $erreurs['nom']; ?></span><?php endif; ?>
        </div>

        <div class="form-group">
            <label for="nom_artiste">Nom d'artiste</label>
            <input type="text" id="nom_artiste" name="nom_artiste" value="<?php echo htmlspecialchars($artiste['nom_artiste'] ?? ''); ?>">
        </div>

        <div class="form-group">
            <label for="email">E-mail *</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($artiste['email']); ?>" <?php echo isset($erreurs['email']) ? 'class="input-error"' : ''; ?>>
            <?php if (isset($erreurs['email'])): ?><span class="field-error"><?php echo $erreurs['email']; ?></span><?php endif; ?>
        </div>

        <div class="form-group">
            <label for="description">Biographie</label>
            <textarea id="description" name="description"><?php echo htmlspecialchars($artiste['description'] ?? ''); ?></textarea>
        </div>

        <h2 class="section-title">Changer de mot de passe</h2>
        <p class="page-description">Laisser vide pour conserver le mot de passe actuel.</p>

        <div class="form-group">
            <label for="mot_de_passe">Nouveau mot de passe</label>
            <input type="password" id="mot_de_passe" name="mot_de_passe">
        </div>

        <div class="form-group">
            <label for="mot_de_passe_confirm">Confirmer le mot de passe</label>
            <input type="password" id="mot_de_passe_confirm" name="mot_de_passe_confirm" <?php echo isset($erreurs['mot_de_passe_confirm']) ? 'class="input-error"' : ''; ?>>
            <?php if (isset($erreurs['mot_de_passe_confirm'])): ?><span class="field-error"><?php echo $erreurs['mot_de_passe_confirm']; ?></span><?php endif; ?>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn">Enregistrer le profil</button>
        </div>

    </form>
</section>

<section class="program-section">
    <h2 class="section-title">Catalogue de prestations</h2>

    <?php if (empty($prestations)): ?>
        <p class="no-results">Aucune prestation pour cet artiste.</p>
    <?php else: ?>
        <table class="program-table">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Catégorie</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($prestations as $p): ?>
                    <tr>
                        <td><a href="fiche-prestation.php?id=<?php echo $p['id']; ?>"><?php echo htmlspecialchars($p['titre']); ?></a></td>
                        <td><?php echo htmlspecialchars($p['categorie']); ?></td>
                        <td><?php echo $p['est_programmee'] ? 'Programmée' : 'Non programmée'; ?></td>
                        <td>
                            <a href="modifier-prestation.php?id=<?php echo $p['id']; ?>&source=organisateur&source_artiste=<?php echo $artisteId; ?>" class="btn">Modifier</a>
                            <a href="supprimer-prestation.php?id=<?php echo $p['id']; ?>&source=organisateur&source_artiste=<?php echo $artisteId; ?>" class="btn btn-danger">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</section>

<?php include 'app/view/footer.php'; ?>
