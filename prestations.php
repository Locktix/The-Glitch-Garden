<?php
require_once 'app/model/prestation.php';
use app\model\Prestation;

$listePrestations = Prestation::getAll();

require_once 'app/view/components/prestation-card.php';

$page = 'prestations';
include 'app/view/header.php';
?>

        <a href="index.php" class="back-link">&larr; Retour à l'accueil</a>
        <h1 class="page-title">Nos Prestations</h1>
        <p class="page-description">Explorez les performances, ateliers et lives prévus pour cette édition.</p>
        <div class="filter-container">
            <form action="#" method="GET" class="filter-form">
                <div class="filter-group">
                    <label for="search">Mot-clé</label>
                    <input type="text" id="search" name="search" placeholder="Nom, description...">
                </div>
                <div class="filter-group">
                    <label for="artiste">Artiste</label>
                    <select id="artiste" name="artiste">
                        <option value="">Tous les artistes</option>
                        <option value="cyber_pulse">Cyber pulse</option>
                        <option value="deep_harmony">Deep harmony</option>
                        <option value="glitch_master">Glitch master</option>
                        <option value="luna_sync">Luna sync</option>
                        <option value="nexus">NEXUS</option>
                        <option value="wave_motion">Wave motion</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="categorie">Catégorie</label>
                    <select id="categorie" name="categorie">
                        <option value="">Toutes les catégories</option>
                        <option value="DJSet">DJ Set</option>
                        <option value="LiveSet">Live Set</option>
                        <option value="LivePerformance">Live Performance</option>
                        <option value="B2B">B2B Set</option>
                    </select>
                </div>
                <div class="filter-checkbox-group">
                    <input type="checkbox" id="programmed" name="programmed">
                    <label for="programmed">Uniquement programmées</label>
                </div>
                <button type="submit" class="btn-filter">Filtrer</button>
            </form>
        </div>


        <section class="prestations-gallery">
            <?php foreach ($listePrestations as $prestation) {
                afficherCartePrestation(
                    $prestation->getTitre(),
                    $prestation->getCategorie(),
                    $prestation->getArtiste(),
                    $prestation->getHoraire(),
                    $prestation->getScene(),
                    $prestation->getImage()
                );
            } ?>
        </section>

<?php 
include 'app/view/footer.php';
?>