<?php
require_once 'app/database/database.php';
use App\Database\Database;

$ARTISTE_ID = 2; // Cyber pulse — utilisateur fixe en dur

$pdo     = Database::getPDO();
$erreurs = [];

$reqCat = $pdo->prepare("SELECT id, nom FROM categories ORDER BY nom");
$reqCat->execute();
$categories = $reqCat->fetchAll(PDO::FETCH_ASSOC);

$titre       = '';
$description = '';
$categorieId = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre       = trim($_POST['titre'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $categorieId = (int)($_POST['categorie_id'] ?? 0);

    if ($titre === '')    $erreurs['titre']       = 'Le titre est obligatoire.';
    if ($categorieId === 0) $erreurs['categorie_id'] = 'La catégorie est obligatoire.';

    if (empty($erreurs)) {
        $req = $pdo->prepare("INSERT INTO prestations (titre, description, categorie_id, artiste_id) VALUES (:titre, :desc, :cat, :artiste)");
        $req->execute([':titre' => $titre, ':desc' => $description, ':cat' => $categorieId, ':artiste' => $ARTISTE_ID]);
        header('Location: catalogue-artiste.php?succes=' . urlencode('Prestation ajoutée avec succès.'));
        exit;
    }
}

$page = 'ajouter-prestation';
include 'app/view/header.php';
?>

<a href="catalogue-artiste.php" class="back-link">&larr; Retour au catalogue</a>
<h1 class="page-title">Ajouter une prestation</h1>

<form method="POST" action="ajouter-prestation.php">

    <div class="form-group">
        <label for="titre">Titre *</label>
        <input type="text" id="titre" name="titre" value="<?php echo htmlspecialchars($titre); ?>" <?php echo isset($erreurs['titre']) ? 'class="input-error"' : ''; ?>>
        <?php if (isset($erreurs['titre'])): ?><span class="field-error"><?php echo $erreurs['titre']; ?></span><?php endif; ?>
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea id="description" name="description"><?php echo htmlspecialchars($description); ?></textarea>
    </div>

    <div class="form-group">
        <label for="categorie_id">Catégorie *</label>
        <select id="categorie_id" name="categorie_id" <?php echo isset($erreurs['categorie_id']) ? 'class="input-error"' : ''; ?>>
            <option value="">-- Choisir une catégorie --</option>
            <?php foreach ($categories as $cat): ?>
                <option value="<?php echo $cat['id']; ?>" <?php echo ($categorieId === (int)$cat['id']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($cat['nom']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <?php if (isset($erreurs['categorie_id'])): ?><span class="field-error"><?php echo $erreurs['categorie_id']; ?></span><?php endif; ?>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn">Ajouter</button>
        <a href="catalogue-artiste.php" class="btn btn-secondary">Annuler</a>
    </div>

</form>

<?php include 'app/view/footer.php'; ?>
