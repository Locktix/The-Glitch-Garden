<?php
    $page = 'fiche-prestation';
    include 'app/view/header.php';
?>
        <a class="back-link" href="prestations.php">&larr; Retour aux prestations</a>

        <h1 class="page-title">Set 1 : Warm-up: Deep House</h1>

        <div class="fiche-grid">
            <div class="fiche-image">
                <img src="assets/img/scenes/main_stage_set.jpg" alt="Photo de la Scène Principale pour la prestation Warm-up Deep House">
            </div>

            <div class="fiche-details">
                <div class="categorie-badge">Catégorie: <span class="categorie">Musique électronique</span></div>

                <p class="description">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Doloribus incidunt unde autem ex ducimus consequuntur modi sit aspernatur, eos pariatur laboriosam veniam molestias voluptatem. Atque accusamus placeat itaque odit sapiente.
                </p>

                <span class="proposed-by">
                    <strong>Proposé par</strong>:
                    <a class="artiste-name" href="fiche-artiste.php">Cyber Pulse</a>
                </span>

                <div class="badge-programmation">
                    <div class="heure">11:00</div>
                    <div class="scene">Scène : Scène Principale</div>
                </div>

            </div>
        </div>
    </main>
<?php 
include 'app/view/footer.php';
?>