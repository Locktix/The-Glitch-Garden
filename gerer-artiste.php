<?php
require_once 'app/model/utilisateur.php';
require_once 'app/model/programmation.php';

use app\model\Utilisateur;
use app\model\Programmation;

$erreurs   = [];
$succes    = '';
$artisteId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$artiste = Utilisateur::getByIdArtiste($artisteId);

if (!$artiste) {
    header('Location: gerer-artistes.php');
    exit;
}

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
    } elseif (Utilisateur::emailExiste($email, $artisteId)) {
        $erreurs['email'] = "Cet e-mail est déjà utilisé.";
    }

    if ($mdp !== '' && $mdp !== $mdpConfirm) {
        $erreurs['mot_de_passe_confirm'] = "Les mots de passe ne correspondent pas.";
    }

    if (empty($erreurs)) {
        $artiste->setNom($nom);
        $artiste->setPrenom($prenom);
        $artiste->setEmail($email);
        $artiste->setDescription($description);
        $artiste->setNomArtiste($nomArtiste);
        $artiste->update($mdp !== '' ? $mdp : null);
        $succes = "Profil mis à jour avec succès.";
        $artiste = Utilisateur::getByIdArtiste($artisteId);
    } else {
        $artiste->setNom($nom);
        $artiste->setPrenom($prenom);
        $artiste->setEmail($email);
        $artiste->setDescription($description);
        $artiste->setNomArtiste($nomArtiste);
    }
}

$prestations = Programmation::getCatalogueArtiste($artisteId);
$succes      = $succes ?: (isset($_GET['succes']) ? $_GET['succes'] : '');

$page = 'gerer-artiste';
include 'app/view/header.php';
?>

<a href="gerer-artistes.php" class="back-link">&larr; Retour à la liste des artistes</a>
<h1 class="page-title">Gérer : <?php echo htmlspecialchars($artiste->getNomArtiste() ?: $artiste->getPrenom() . ' ' . $artiste->getNom()); ?></h1>

<?php if ($succes): ?>
    <div class="succes-message"><?php echo htmlspecialchars($succes); ?></div>
<?php endif; ?>

<section class="program-section">
    <h2 class="section-title">Profil de l'artiste</h2>

    <form method="POST" action="gerer-artiste.php?id=<?php echo $artisteId; ?>">

        <div class="form-group">
            <label for="prenom">Prénom *</label>
            <input type="text" id="prenom" name="prenom" value="<?php echo htmlspecialchars($artiste->getPrenom()); ?>" <?php echo isset($erreurs['prenom']) ? 'class="input-error"' : ''; ?>>
            <?php if (isset($erreurs['prenom'])): ?><span class="field-error"><?php echo $erreurs['prenom']; ?></span><?php endif; ?>
        </div>

        <div class="form-group">
            <label for="nom">Nom *</label>
            <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($artiste->getNom()); ?>" <?php echo isset($erreurs['nom']) ? 'class="input-error"' : ''; ?>>
            <?php if (isset($erreurs['nom'])): ?><span class="field-error"><?php echo $erreurs['nom']; ?></span><?php endif; ?>
        </div>

        <div class="form-group">
            <label for="nom_artiste">Nom d'artiste</label>
            <input type="text" id="nom_artiste" name="nom_artiste" value="<?php echo htmlspecialchars($artiste->getNomArtiste()); ?>">
        </div>

        <div class="form-group">
            <label for="email">E-mail *</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($artiste->getEmail()); ?>" <?php echo isset($erreurs['email']) ? 'class="input-error"' : ''; ?>>
            <?php if (isset($erreurs['email'])): ?><span class="field-error"><?php echo $erreurs['email']; ?></span><?php endif; ?>
        </div>

        <div class="form-group">
            <label for="description">Biographie</label>
            <textarea id="description" name="description"><?php echo htmlspecialchars($artiste->getDescription()); ?></textarea>
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
