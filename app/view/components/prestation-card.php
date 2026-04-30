<?php

function afficherCartePrestation(int $id, string $nom, string $categorie, string $artiste, string $heure, string $scene, string $image): void {

    ?>
    <a href="fiche-prestation.php?id=<?php echo $id; ?>" class="vignette">
        <article>
            <div class="vignette-image">
                <img src="<?php echo htmlspecialchars($image); ?>" alt="Vue de la scène <?php echo htmlspecialchars($scene); ?> pour le set <?php echo htmlspecialchars($nom); ?>">
            </div>
            <div class="vignette-content">
                <span class="category-tag"><?php echo htmlspecialchars($categorie); ?></span>
                <h2><?php echo htmlspecialchars($nom); ?></h2>
                <span class="artiste-name">par <?php echo htmlspecialchars($artiste); ?></span>
                <?php if ($heure !== 'Non programmée'): ?>
                <div class="badge-programmation">
                    <span class="heure"><?php echo htmlspecialchars($heure); ?></span> — <span class="scene"><?php echo htmlspecialchars($scene); ?></span>
                </div>
                <?php endif; ?>
            </div>
        </article>
    </a>

    <?php
}

?>