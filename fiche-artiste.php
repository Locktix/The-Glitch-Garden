<?php
    $page = 'fiche-artiste';
    include 'app/View/header.php';
?>
        
        <a href="artistes.html" class="back-link">&larr; Retour à la liste des artistes</a>

        <h1 class="page-title">Cyber pulse</h1>

        <div class="artist-profile-header">
            <img src="assets/img/artistes/cyber_pulse.jpg" alt="Portrait de Cyber pulse" class="artist-photo">
            
            <div class="artist-presentation">
                <span class="artist-real-name">Nom réel : Antoine Dupont</span>

                <h2>Styles Musicaux</h2>
                <ul class="styles-tags">
                    <li class="style-tag">Electro House</li>
                    <li class="style-tag">Future Rave</li>
                </ul>
            </div>
        </div>

        <section class="artist-bio-section">
            <h2>Biographie</h2>
            <p class="artist-bio">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem est maiores nam quidem eveniet doloribus eligendi dolorum eaque distinctio, cum deleniti sequi odio praesentium incidunt ducimus veritatis. Atque, modi a?
            </p>
            <p class="artist-bio">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit, ipsa natus laudantium nihil, veniam neque expedita a beatae et qui placeat accusantium praesentium tenetur temporibus excepturi minus porro, laboriosam quaerat?
            </p>
        </section>

        <section class="artiste-programmation">
            <h2>Prochaines Performances</h2>
            <div class="programmation-list">
                <a href="fiche-prestation.html" class="prestation-card-link">
                    <article class="programmation-detail-card">
                        <img src="assets/img/scenes/main_stage_set.jpg" alt="Vue de la Scène Principale pour le set Warm-up Deep House" class="programmation-img">
                        
                        <h3>Set 1 : Warm-up: Deep House</h3>
                        <div class="detail-info">
                            <span class="time">11:00 - 13:00</span>
                            <span class="stage">Scène principale</span>
                        </div>
                    </article>
                </a>
                <a href="fiche-prestation.html" class="prestation-card-link">
                    <article class="programmation-detail-card">
                        <img src="assets/img/scenes/main_stage_set.jpg" alt="Vue de la Scène Principale pour le set Back to Back" class="programmation-img">
                        
                        <h3>Set 2 : Warm-up: Back to Back</h3>
                        <div class="detail-info">
                            <span class="time">19:00 - 22:30</span>
                            <span class="stage">Scène principale</span>
                        </div>
                    </article>
                </a>
            </div>
        </section>

<?php 
include 'app/View/footer.php';
?>