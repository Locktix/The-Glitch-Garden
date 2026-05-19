<?php
require_once 'app/model/programmation.php';

use app\model\Programmation;

$programme = [];
$heures    = [];
$scenes    = ['Scène Principale', 'Temple Techno', 'Jardin Chillout'];
$erreur    = '';

try {
    foreach (Programmation::getGrille() as $row) {
        $heure = $row['heure'];
        $scene = $row['scene'];
        if (!in_array($heure, $heures)) {
            $heures[] = $heure;
        }
        $programme[$heure][$scene] = [
            'id'      => $row['prestation_id'],
            'titre'   => $row['titre'],
            'artiste' => $row['artiste'],
        ];
    }
} catch (PDOException $e) {
    $erreur = "Erreur : " . $e->getMessage();
}

$page = 'accueil';
include 'app/view/header.php';
?>

<section class="hero-section">
    <h1 class="hero-title">The Glitch Garden</h1>
    <p class="hero-text">
        The Glitch Garden est votre porte d'entrée vers l'électro underground.
        Découvrez une journée complète d'exploration sonore intense ! Des basses lourdes du Temple Techno
        aux sessions cosmiques de la Scène Principale, trouvez votre équilibre dans l'oasis du Jardin Chillout.
        De la Drum &amp; Bass au Melodic Techno, vivez un voyage rythmique où le futur du son prend racine.
        Bienvenue dans la prochaine dimension du beat.
    </p>
</section>

<section class="program-section">
    <h2 class="section-title">Programme de la journée</h2>
    <p class="section-description">Découvrez les prestations par scène et par heure</p>

    <?php if ($erreur): ?>
        <div class="error-message"><p><?php echo $erreur; ?></p></div>
    <?php elseif (empty($heures)): ?>
        <p class="no-results">Aucune prestation programmée pour le moment.</p>
    <?php else: ?>
        <table class="program-table">
            <caption>Programme détaillé du festival par heure et par scène</caption>
            <thead>
                <tr>
                    <th>Heures</th>
                    <?php foreach ($scenes as $scene): ?>
                        <th><?php echo htmlspecialchars($scene); ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($heures as $heure): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($heure); ?></td>
                        <?php foreach ($scenes as $scene): ?>
                            <td>
                                <?php if (isset($programme[$heure][$scene])): ?>
                                    <a href="fiche-prestation.php?id=<?php echo $programme[$heure][$scene]['id']; ?>">
                                        <?php echo htmlspecialchars($programme[$heure][$scene]['titre']); ?>
                                        <br>
                                        <small><?php echo htmlspecialchars($programme[$heure][$scene]['artiste']); ?></small>
                                    </a>
                                <?php endif; ?>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

</section>

<?php include 'app/view/footer.php'; ?>
