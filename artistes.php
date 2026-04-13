<?php
require_once 'app/model/artiste.php';
use app\model\Artiste;

$listeArtistes = Artiste::getAll();

require_once 'app/view/components/artiste-card.php';

$page = 'artistes';
include 'app/view/header.php';
?>
	
	<a href="index.php" class="back-link">&larr; Retour à l'accueil</a>
	<h1 class="page-title">Artistes Programmés au Glitch Garden</h1>
	<p class="page-description">Découvrez les profils complets des DJ et producteurs présents lors de cette édition.</p>
	<div class="filter-container">
		<span class="visually-hidden-flex">Options de filtrage</span>
		<input type="checkbox" id="filter-toggle" name="filter-programmed">
		<label for="filter-toggle" class="filter-label">Afficher uniquement les artistes programmés</label>
	</div>
	
	<section class="artistes-list">
		<?php foreach ($listeArtistes as $artiste) {
			afficherCarteArtiste(
				$artiste->getNom(),
				$artiste->getBio(),
				$artiste->getStyles(),
				$artiste->getProgrammation(),
				$artiste->getImage()
			);
		} ?>
	</section>

<?php 
include 'app/view/footer.php';
?>
