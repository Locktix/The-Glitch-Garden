<?php
require_once 'app/model/artiste.php';
require_once 'app/model/prestation.php';

use app\model\Artiste;
use app\model\Prestation;

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id === 0) {
    header('Location: artistes.php?erreur=' . urlencode('Artiste introuvable.'));
    exit;
}

try {
    $artiste = Artiste::getById($id);
} catch (PDOException $e) {
    header('Location: artistes.php?erreur=' . urlencode('Erreur : ' . $e->getMessage()));
    exit;
}

if (!$artiste) {
    header('Location: artistes.php?erreur=' . urlencode('Artiste introuvable.'));
    exit;
}

$page = 'fiche-artiste';
include 'app/view/header.php';
?>

<a href="artistes.php" class="back-link">&larr; Retour à la liste des artistes</a>

<h1 class="page-title"><?php echo htmlspecialchars($artiste->getNom()); ?></h1>

<div class="artist-profile-header">
    <img src="<?php echo htmlspecialchars($artiste->getImage()); ?>" alt="Portrait de <?php echo htmlspecialchars($artiste->getNom()); ?>" class="artist-photo">

    <div class="artist-presentation">
        <span class="artist-real-name">Nom réel : <?php echo htmlspecialchars($artiste->getNomReel()); ?></span>

        <h2>Styles Musicaux</h2>
        <ul class="styles-tags">
            <?php foreach ($artiste->getStyles() as $style): ?>
                <li class="style-tag"><?php echo htmlspecialchars($style); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

<section class="artist-bio-section">
    <h2>Biographie</h2>
    <p class="artist-bio"><?php echo htmlspecialchars($artiste->getBio()); ?></p>
</section>

<?php $prestations = Prestation::getByArtisteId($artiste->getId()); ?>
<?php if (!empty($prestations)): ?>
<section class="artiste-programmation">
    <h2>Ses Prestations</h2>
    <div class="programmation-list">
        <?php foreach ($prestations as $i => $perf): ?>
            <a href="fiche-prestation.php?id=<?php echo $perf->getId(); ?>" class="prestation-card-link">
                <article class="programmation-detail-card">
                    <img src="<?php echo htmlspecialchars($perf->getImage()); ?>" alt="<?php echo htmlspecialchars($perf->getTitre()); ?>" class="programmation-img">
                    <h3><?php echo htmlspecialchars($perf->getTitre()); ?></h3>
                    <?php if ($perf->getHoraire() !== 'Non programmée'): ?>
                    <div class="detail-info">
                        <span class="time"><?php echo htmlspecialchars($perf->getHoraire()); ?></span>
                        <span class="stage"><?php echo htmlspecialchars($perf->getScene()); ?></span>
                    </div>
                    <?php endif; ?>
                </article>
            </a>
        <?php endforeach; ?>
    </div>
</section>
<?php endif; ?>

<?php include 'app/view/footer.php'; ?>
