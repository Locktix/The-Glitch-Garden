<?php
require_once 'app/model/artiste.php';

use app\model\Artiste;

$artistes = [];
$erreur = '';

try {
    $artistes = Artiste::getAll();
} catch (PDOException $e) {
    $erreur = "Erreur : " . $e->getMessage();
}

$erreur = $erreur ?: (isset($_GET['erreur']) ? htmlspecialchars($_GET['erreur']) : '');

require_once 'app/view/components/artiste-card.php';

$page = 'artistes';
include 'app/view/header.php';
?>
	
	<a href="index.php" class="back-link">&larr; Retour à l'accueil</a>
	<h1 class="page-title">Artistes Programmés au Glitch Garden</h1>
	<p class="page-description">Découvrez les profils complets des DJ et producteurs présents lors de cette édition.</p>
	<input type="checkbox" id="filter-toggle" name="filter-programmed">
	<div class="filter-container">
		<span class="visually-hidden-flex">Options de filtrage</span>
		<label for="filter-toggle" class="filter-label">Afficher uniquement les artistes programmés</label>
	</div>

	<?php if ($erreur): ?>
		<div class="error-message">
			<p><?php echo $erreur; ?></p>
		</div>
	<?php endif; ?>
	
	<?php if (empty($artistes) && !$erreur): ?>
		<p class="no-results">Aucun artiste trouvé.</p>
	<?php else: ?>
		<section class="artistes-list">
			<p class="no-artiste-filter">Aucun artiste programmé à afficher.</p>
			<?php foreach ($artistes as $artiste) {
				afficherCarteArtiste(
					$artiste->getId(),
					$artiste->getNom(),
					$artiste->getBio(),
					$artiste->getStyles(),
					$artiste->getProgrammation(),
					$artiste->getImage()
				);
			} ?>
		</section>
	<?php endif; ?>

<?php 
include 'app/view/footer.php';
?>
