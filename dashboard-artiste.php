<?php
require_once 'app/model/utilisateur.php';
require_once 'app/model/programmation.php';

use app\model\Utilisateur;
use app\model\Programmation;

$ARTISTE_ID = 2; // Cyber pulse — utilisateur fixe en dur

$artiste      = Utilisateur::getByIdArtiste($ARTISTE_ID);
$performances = Programmation::getByArtisteId($ARTISTE_ID);

$page = 'dashboard-artiste';
include 'app/view/header.php';
?>

<h1 class="page-title">Dashboard Artiste</h1>

<div class="artist-profile-header">
    <div class="artist-presentation">
        <span class="artist-real-name"><?php echo htmlspecialchars($artiste->getPrenom() . ' ' . $artiste->getNom()); ?></span>
        <h2><?php echo htmlspecialchars($artiste->getNomArtiste()); ?></h2>
    </div>
</div>

<section class="program-section">
    <h2 class="section-title">Mes prestations programmées</h2>
    <?php if (empty($performances)): ?>
        <p class="no-results">Vous n'êtes pas encore programmé.</p>
    <?php else: ?>
        <table class="program-table">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Heure</th>
                    <th>Scène</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($performances as $p): ?>
                    <tr>
                        <td><a href="fiche-prestation.php?id=<?php echo $p['id']; ?>"><?php echo htmlspecialchars($p['titre']); ?></a></td>
                        <td><?php echo htmlspecialchars($p['heure']); ?></td>
                        <td><?php echo htmlspecialchars($p['scene']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</section>

<div class="form-actions">
    <a href="profil.php?type=artiste" class="btn">Éditer mon profil</a>
    <a href="catalogue-artiste.php" class="btn">Gérer mon catalogue de prestations</a>
</div>

<?php include 'app/view/footer.php'; ?>
