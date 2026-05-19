<?php
require_once 'app/model/prestation.php';
require_once 'app/model/categorie.php';

use app\model\Prestation;
use app\model\Categorie;

$erreurs = [];

$id            = isset($_GET['id'])             ? (int)$_GET['id']             : 0;
$source        = isset($_GET['source'])         ? $_GET['source']              : 'artiste';
$sourceArtiste = isset($_GET['source_artiste']) ? (int)$_GET['source_artiste'] : 0;

$retour = ($source === 'organisateur' && $sourceArtiste > 0)
    ? 'gerer-artiste.php?id=' . $sourceArtiste
    : 'catalogue-artiste.php';

$categories = Categorie::getAll();
$prestation = Prestation::getById($id);

if (!$prestation) {
    header('Location: ' . $retour);
    exit;
}

$titre       = $prestation->getTitre();
$description = $prestation->getDescription();
$categorieId = $prestation->getCategorieId();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre       = trim($_POST['titre'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $categorieId = (int)($_POST['categorie_id'] ?? 0);

    if ($titre === '')      $erreurs['titre']       = 'Le titre est obligatoire.';
    if ($categorieId === 0) $erreurs['categorie_id'] = 'La catégorie est obligatoire.';

    if (empty($erreurs)) {
        $prestation->setTitre($titre);
        $prestation->setDescription($description);
        $prestation->setCategorieId($categorieId);
        $prestation->update();
        header('Location: ' . $retour . '?succes=' . urlencode('Prestation modifiée avec succès.'));
        exit;
    }
}

$page = 'modifier-prestation';
include 'app/view/header.php';
?>

<a href="<?php echo $retour; ?>" class="back-link">&larr; Retour</a>
<h1 class="page-title">Modifier la prestation</h1>

<form method="POST" action="modifier-prestation.php?id=<?php echo $id; ?>&source=<?php echo htmlspecialchars($source); ?>&source_artiste=<?php echo $sourceArtiste; ?>">

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
                <option value="<?php echo $cat->getId(); ?>" <?php echo ($categorieId === $cat->getId()) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($cat->getNom()); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <?php if (isset($erreurs['categorie_id'])): ?><span class="field-error"><?php echo $erreurs['categorie_id']; ?></span><?php endif; ?>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn">Enregistrer</button>
        <a href="<?php echo $retour; ?>" class="btn btn-secondary">Annuler</a>
    </div>

</form>

<?php include 'app/view/footer.php'; ?>
