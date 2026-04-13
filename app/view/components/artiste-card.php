<?php


function afficherCarteArtiste(string $nom, string $description, array $styles, array $programmation, string $image): void {

    ?>
    <a href="fiche-artiste.php" class="artiste-card-link">
        <article class="artiste-card">
            <img src="<?php echo htmlspecialchars($image); ?>" alt="Portrait de l'artiste <?php echo htmlspecialchars($nom); ?>">
            <h2><?php echo htmlspecialchars($nom); ?></h2>
            <span class="artiste-description">
                <?php echo htmlspecialchars($description); ?>
            </span>
            <ul class="styles-tags">
                <?php foreach ($styles as $style): ?>
                    <li class="style-tag"><?php echo htmlspecialchars($style); ?></li>
                <?php endforeach; ?>
            </ul>
            <h3>Programmation</h3>
            <ul class="programmed-dates">
                <?php 
                if (is_array($programmation) && count($programmation) > 0) {
                    foreach ($programmation as $date): ?>
                        <li><?php echo htmlspecialchars($date); ?></li>
                    <?php endforeach; 
                } else {
                    echo '<li>Aucune programmation disponible</li>';
                }
                ?>
            </ul>
        </article>
    </a>

<?php
}