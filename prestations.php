<?php
require_once 'app/model/prestation.php';
require_once 'app/model/utilisateur.php';

use app\model\Prestation;
use app\model\Utilisateur;

$listePrestations = [];
$erreur = '';

try {
    $listePrestations = Prestation::getAll();
} catch (PDOException $e) {
    $erreur = "Erreur : " . $e->getMessage();
}

$erreur  = $erreur ?: (isset($_GET['erreur']) ? htmlspecialchars($_GET['erreur']) : '');
$artistes = Utilisateur::getAll();

$search         = isset($_GET['search'])    ? trim($_GET['search'])   : '';
$artisteFiltre  = isset($_GET['artiste'])   ? (int)$_GET['artiste']   : 0;
$catFiltre      = isset($_GET['categorie']) ? trim($_GET['categorie']) : '';
$programmeeOnly = isset($_GET['programmed']);

$listeFiltree = [];
foreach ($listePrestations as $prestation) {
    if ($search !== '' && stripos($prestation->getTitre(), $search) === false && stripos($prestation->getDescription(), $search) === false) {
        continue;
    }
    if ($artisteFiltre > 0 && $prestation->getArtisteId() !== $artisteFiltre) {
        continue;
    }
    if ($catFiltre !== '' && $prestation->getCategorie() !== $catFiltre) {
        continue;
    }
    if ($programmeeOnly && $prestation->getHoraire() === 'Non programmée') {
        continue;
    }
    $listeFiltree[] = $prestation;
}

require_once 'app/view/components/prestation-card.php';

$page = 'prestations';
include 'app/view/header.php';
?>

        <a href="index.php" class="back-link">&larr; Retour à l'accueil</a>
        <h1 class="page-title">Nos Prestations</h1>
        <p class="page-description">Explorez les performances, ateliers et lives prévus pour cette édition.</p>

        <div class="filter-container">
            <form action="prestations.php" method="GET" class="filter-form">

                <div class="filter-group">
                    <label for="search">Mot-clé</label>
                    <input type="text" id="search" name="search" placeholder="Nom de la prestation..." value="<?php echo htmlspecialchars($search); ?>">
                </div>

                <div class="filter-group">
                    <label for="artiste">Artiste</label>
                    <select id="artiste" name="artiste">
                        <option value="">Tous les artistes</option>
                        <?php foreach ($artistes as $artiste): ?>
                            <option value="<?php echo $artiste->getId(); ?>" <?php echo ($artisteFiltre === $artiste->getId()) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($artiste->getNomArtiste()); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="filter-group">
                    <label for="categorie">Catégorie</label>
                    <select id="categorie" name="categorie">
                        <option value="">Toutes les catégories</option>
                        <option value="DJ Set"           <?php echo ($catFiltre === 'DJ Set')           ? 'selected' : ''; ?>>DJ Set</option>
                        <option value="Live Set"         <?php echo ($catFiltre === 'Live Set')         ? 'selected' : ''; ?>>Live Set</option>
                        <option value="Live Performance" <?php echo ($catFiltre === 'Live Performance') ? 'selected' : ''; ?>>Live Performance</option>
                        <option value="B2B Set"          <?php echo ($catFiltre === 'B2B Set')          ? 'selected' : ''; ?>>B2B Set</option>
                    </select>
                </div>

                <div class="filter-checkbox-group">
                    <input type="checkbox" id="programmed" name="programmed" <?php echo $programmeeOnly ? 'checked' : ''; ?>>
                    <label for="programmed">Uniquement programmées</label>
                </div>

                <button type="submit" class="btn-filter">Filtrer</button>

            </form>
        </div>

        <?php if ($erreur): ?>
            <div class="error-message">
                <p><?php echo $erreur; ?></p>
            </div>
        <?php endif; ?>

        <?php if (empty($listeFiltree) && !$erreur): ?>
            <p class="no-results">Aucune prestation ne correspond à votre recherche.</p>
        <?php endif; ?>

        <section class="prestations-gallery">
            <?php foreach ($listeFiltree as $prestation) {
                afficherCartePrestation(
                    $prestation->getId(),
                    $prestation->getTitre(),
                    $prestation->getCategorie(),
                    $prestation->getArtiste(),
                    $prestation->getHoraire(),
                    $prestation->getScene(),
                    $prestation->getImage()
                );
            } ?>
        </section>

<?php include 'app/view/footer.php'; ?>
