<?php
    $page = 'prestations';
    include 'app/View/header.php';
?>
        <a href="index.html" class="back-link">&larr; Retour à l'accueil</a>

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
            <a href="fiche-prestation.html" class="vignette">
                <article>
                    <div class="vignette-image">
                        <img src="assets/img/scenes/temple_techno.jpg" alt="Vue de la scène Temple Techno pour le set Drum and Bass Grooves">
                    </div>
                    <div class="vignette-content">
                        <span class="category-tag">DJ Set</span>
                        <h2>Drum &amp; Bass Grooves</h2>
                        <span class="artiste-name">par Wave motion</span>

                        <div class="badge-programmation">
                            <span class="heure">10h00</span> — <span class="scene">Temple Techno</span>
                        </div>
                    </div>
                </article>
            </a>

            <a href="fiche-prestation.html" class="vignette">
                <article>
                    <div class="vignette-image">
                        <img src="assets/img/scenes/jardin_chillout.jpg" alt="Vue de la scène Jardin Chillout pour le set Ambient Morning Flow">
                    </div>
                    <div class="vignette-content">
                        <span class="category-tag">Live Set</span>
                        <h2>Ambient Morning Flow</h2>
                        <span class="artiste-name">par Luna sync</span>

                        <div class="badge-programmation">
                            <span class="heure">10h00</span> — <span class="scene">Jardin Chillout</span>
                        </div>
                    </div>
                </article>
            </a>

            <a href="fiche-prestation.html" class="vignette">
                <article>
                    <div class="vignette-image">
                        <img src="assets/img/scenes/main_stage_set.jpg" alt="Vue de la Scène Principale pour le set Warm-up Deep House">
                    </div>
                    <div class="vignette-content">
                        <span class="category-tag">DJ Set</span>
                        <h2>Warm-up: Deep House</h2>
                        <span class="artiste-name">par Deep harmony</span>

                        <div class="badge-programmation">
                            <span class="heure">11h00</span> — <span class="scene">Scène Principale</span>
                        </div>
                    </div>
                </article>
            </a>

            <a href="fiche-prestation.html" class="vignette">
                <article>
                    <div class="vignette-image">
                        <img src="assets/img/scenes/jardin_chillout.jpg" alt="Vue de la scène Jardin Chillout pour le set Reggae Dub Sessions">
                    </div>
                    <div class="vignette-content">
                        <span class="category-tag">DJ Set</span>
                        <h2>Reggae/Dub Sessions</h2>
                        <span class="artiste-name">par Glitch master</span>

                        <div class="badge-programmation">
                            <span class="heure">11h00</span> — <span class="scene">Jardin Chillout</span>
                        </div>
                    </div>
                </article>
            </a>

            <a href="fiche-prestation.html" class="vignette">
                <article>
                    <div class="vignette-image">
                        <img src="assets/img/scenes/temple_techno.jpg" alt="Vue de la scène Temple Techno pour le set Hard Groove">
                    </div>
                    <div class="vignette-content">
                        <span class="category-tag">DJ Set</span>
                        <h2>Hard Groove Set</h2>
                        <span class="artiste-name">par NEXUS</span>

                        <div class="badge-programmation">
                            <span class="heure">13h00</span> — <span class="scene">Temple Techno</span>
                        </div>
                    </div>
                </article>
            </a>

            <a href="fiche-prestation.html" class="vignette">
                <article>
                    <div class="vignette-image">
                        <img src="assets/img/scenes/main_stage_set.jpg" alt="Vue de la Scène Principale pour le live Synthwave Pop">
                    </div>
                    <div class="vignette-content">
                        <span class="category-tag">Live Performance</span>
                        <h2>Live Synthwave Pop</h2>
                        <span class="artiste-name">par Cyber pulse</span>

                        <div class="badge-programmation">
                            <span class="heure">14h00</span> — <span class="scene">Scène Principale</span>
                        </div>
                    </div>
                </article>
            </a>

            <a href="fiche-prestation.html" class="vignette">
                <article>
                    <div class="vignette-image">
                        <img src="assets/img/scenes/temple_techno.jpg" alt="Vue de la scène Temple Techno pour le live Acid Performance">
                    </div>
                    <div class="vignette-content">
                        <span class="category-tag">Live Performance</span>
                        <h2>Acid Live Performance</h2>
                        <span class="artiste-name">par Deep harmony</span>

                        <div class="badge-programmation">
                            <span class="heure">14h00</span> — <span class="scene">Temple Techno</span>
                        </div>
                    </div>
                </article>
            </a>

            <a href="fiche-prestation.html" class="vignette">
                <article>
                    <div class="vignette-image">
                        <img src="assets/img/scenes/main_stage_set.jpg" alt="Vue de la Scène Principale pour le set Back to Back">
                    </div>
                    <div class="vignette-content">
                        <span class="category-tag">B2B Set</span>
                        <h2>Warm-up: Back to Back</h2>
                        <span class="artiste-name">par Cyber pulse &amp; Wave motion</span>

                        <div class="badge-programmation">
                            <span class="heure">19h00</span> — <span class="scene">Scène Principale</span>
                        </div>
                    </div>
                </article>
            </a>

            <a href="fiche-prestation.html" class="vignette">
                <article>
                    <div class="vignette-image">
                        <img src="assets/img/scenes/main_stage_set.jpg" alt="Vue de la Scène Principale pour le live Neon Drift Experience">
                    </div>
                    <div class="vignette-content">
                        <span class="category-tag">Live Performance</span>
                        <h2>Neon Drift Experience</h2>
                        <span class="artiste-name">par Luna sync</span>

                        <div class="badge-programmation">
                            <span class="heure">Non programmée</span>
                        </div>
                    </div>
                </article>
            </a>

            <a href="fiche-prestation.html" class="vignette">
                <article>
                    <div class="vignette-image">
                        <img src="assets/img/scenes/temple_techno.jpg" alt="Vue de la scène Temple Techno pour le set Industrial Chaos">
                    </div>
                    <div class="vignette-content">
                        <span class="category-tag">DJ Set</span>
                        <h2>Industrial Chaos</h2>
                        <span class="artiste-name">par NEXUS</span>

                        <div class="badge-programmation">
                            <span class="heure">Non programmée</span>
                        </div>
                    </div>
                </article>
            </a>
        </section>
<?php 
include 'app/View/footer.php';
?>