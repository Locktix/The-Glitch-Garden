<?php
require_once 'app/model/prestation.php';

use app\model\Prestation;

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id === 0) {
    header('Location: prestations.php?erreur=' . urlencode('Prestation introuvable.'));
    exit;
}

try {
    $prestation = Prestation::getById($id);
} catch (PDOException $e) {
    header('Location: prestations.php?erreur=' . urlencode('Erreur : ' . $e->getMessage()));
    exit;
}

if (!$prestation) {
    header('Location: prestations.php?erreur=' . urlencode('Prestation introuvable.'));
    exit;
}

$page = 'fiche-prestation';
include 'app/view/header.php';
?>

<a class="back-link" href="prestations.php">&larr; Retour aux prestations</a>

<h1 class="page-title"><?php echo htmlspecialchars($prestation->getTitre()); ?></h1>

<div class="fiche-grid">
    <div class="fiche-image">
        <img src="<?php echo htmlspecialchars($prestation->getImage()); ?>" alt="Photo de <?php echo htmlspecialchars($prestation->getScene()); ?> pour la prestation <?php echo htmlspecialchars($prestation->getTitre()); ?>">
    </div>

    <div class="fiche-details">
        <div class="categorie-badge">Catégorie: <span class="categorie"><?php echo htmlspecialchars($prestation->getCategorie()); ?></span></div>

        <p class="description"><?php echo htmlspecialchars($prestation->getDescription()); ?></p>

        <span class="proposed-by">
            <strong>Proposé par</strong> :
            <a class="artiste-name" href="fiche-artiste.php?id=<?php echo $prestation->getArtisteId(); ?>"><?php echo htmlspecialchars($prestation->getArtiste()); ?></a>
        </span>

        <div class="badge-programmation">
            <div class="heure"><?php echo htmlspecialchars($prestation->getHoraire()); ?></div>
            <div class="scene">Scène : <?php echo htmlspecialchars($prestation->getScene()); ?></div>
        </div>
    </div>
</div>

<?php include 'app/view/footer.php'; ?>
