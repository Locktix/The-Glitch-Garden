<?php
    $page = 'artistes';
    include __DIR__ . '/../View/header.php';
?>
        
        <a href="index.html" class="back-link">&larr; Retour à l'accueil</a>

        <h1 class="page-title">Artistes Programmés au Glitch Garden</h1>
        <p class="page-description">Découvrez les profils complets des DJ et producteurs présents lors de cette édition.</p>

        <div class="filter-container">
            <span class="visually-hidden-flex">Options de filtrage</span>
            <input type="checkbox" id="filter-toggle" name="filter-programmed">
            <label for="filter-toggle" class="filter-label">Afficher uniquement les artistes programmés</label>
        </div>
        
        <section class="artistes-list">
            <a href="fiche-artiste.html" class="artiste-card-link">
                <article class="artiste-card">
                    <img src="assets/img/artistes/cyber_pulse.jpg" alt="Portrait de l'artiste Cyber pulse">
                    <h2>Cyber pulse</h2>
                    <span class="artiste-description">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus voluptates quas alias praesentium quod. Accusamus, illo. Asp
                    </span>
                    <ul class="styles-tags">
                        <li class="style-tag">Electro House</span>
                        <li class="style-tag">Future Rave</li>
                    </ul>

                    <h3>Programmation</h3>
                    <ul class="programmed-dates">
                        <li>14h00 - Live Synthwave Pop - Scène Principale</li>
                        <li>19h00 - Warm-up: Back to Back - Scène Principale</li>
                    </ul>
                </article>
            </a>
            <a href="fiche-artiste.html" class="artiste-card-link">
                <article class="artiste-card">
                    <img src="assets/img/artistes/deep_harmony.jpg" alt="Portrait de l'artiste Deep harmony">
                    <h2>Deep harmony</h2>
                    <span class="artiste-description">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ipsa veritatis inventore laborum. Optio voluptas deleniti rerum consequuntur sus
                    </span>
                    <ul class="styles-tags">
                        <li class="style-tag">Deep House</span>
                        <li class="style-tag">Melodic Techno</li>
                    </ul>

                    <h3>Programmation</h3>
                    <ul class="programmed-dates">
                        <li>11h00 - Warm-up: Deep House - Scène Principale</li>
                        <li>14h00 - Acid Live Performance - Temple Techno</li>
                    </ul>
                </article>
            </a>
            <a href="fiche-artiste.html" class="artiste-card-link">
                <article class="artiste-card">
                    <img src="assets/img/artistes/glitch_master.jpg" alt="Portrait de l'artiste Glitch master">
                    <h2>Glitch master</h2>
                    <span class="artiste-description">
                       Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quia voluptate, debitis voluptatibus delectus faci
                    </span>
                    <ul class="styles-tags">
                        <li class="style-tag">IDM</span>
                        <li class="style-tag">Glitch Hop</li>
                    </ul>

                    <h3>Programmation</h3>
                    <ul class="programmed-dates">
                        <li>11h00 - Reggae/Dub Sessions - Jardin Chillout</li>
                    </ul>
                </article>
            </a>
            <a href="fiche-artiste.html" class="artiste-card-link">
                <article class="artiste-card">
                    <img src="assets/img/artistes/luna_sync.jpg" alt="Portrait de l'artiste Luna sync">
                    <h2>Luna sync</h2>
                    <span class="artiste-description">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur earum sapiente quibusdam voluptatum, natus eligendi temporibus.
                    </span>
                    <ul class="styles-tags">
                        <li class="style-tag">Trance</span>
                        <li class="style-tag">Progressive House</li>
                    </ul>

                    <h3>Programmation</h3>
                    <ul class="programmed-dates">
                        <li>10h00 - Ambient Morning Flow - Jardin Chillout</li>
                    </ul>
                </article>
            </a>
            <a href="fiche-artiste.html" class="artiste-card-link">
                <article class="artiste-card">
                    <img src="assets/img/artistes/NEXUS.jpg" alt="Portrait de l'artiste NEXUS">
                    <h2>NEXUS</h2>
                    <span class="artiste-description">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis quidem pariatur accusantium doloremque voluptates quos repellat.
                    </span>
                    <ul class="styles-tags">
                        <li class="style-tag">Techno</span>
                        <li class="style-tag">Hard Techno</li>
                    </ul>

                    <h3>Programmation</h3>
                    <ul class="programmed-dates">
                        <li>13h00 - Hard Groove Set - Temple Techno</li>
                    </ul>
                </article>
            </a>
            <a href="fiche-artiste.html" class="artiste-card-link">
                <article class="artiste-card">
                    <img src="assets/img/artistes/wave_motion.svg" alt="Portrait de l'artiste Wave motion">
                    <h2>Wave motion</h2>
                    <span class="artiste-description">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis inventore laudantium cumque quisquam aspernatur mollitia veritatis.
                    </span>
                    <ul class="styles-tags">
                        <li class="style-tag">Drum &amp; Bass</span>
                        <li class="style-tag">Liquid Funk</li>
                    </ul>

                    <h3>Programmation</h3>
                    <ul class="programmed-dates">
                        <li>10h00 - Drum &amp; Bass Grooves - Temple Techno</li>
                        <li>19h00 - Warm-up: Back to Back - Scène Principale</li>
                    </ul>
                </article>
            </a>
            </section>

<?php 
include __DIR__ . '/../View/footer.php';
?>