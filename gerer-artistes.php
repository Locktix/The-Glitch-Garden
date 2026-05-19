<?php
require_once 'app/model/utilisateur.php';

use app\model\Utilisateur;

$artistes = Utilisateur::getAll();

$page = 'gerer-artistes';
include 'app/view/header.php';
?>

<a href="dashboard-organisateur.php" class="back-link">&larr; Retour au dashboard</a>
<h1 class="page-title">Gérer les Artistes</h1>

<?php if (empty($artistes)): ?>
    <p class="no-results">Aucun artiste trouvé.</p>
<?php else: ?>
    <table class="program-table">
        <thead>
            <tr>
                <th>Nom artiste</th>
                <th>Nom réel</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($artistes as $artiste): ?>
                <tr>
                    <td><?php echo htmlspecialchars($artiste->getNomArtiste() ?: '-'); ?></td>
                    <td><?php echo htmlspecialchars($artiste->getPrenom() . ' ' . $artiste->getNom()); ?></td>
                    <td><a href="gerer-artiste.php?id=<?php echo $artiste->getId(); ?>" class="btn">Gérer</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php include 'app/view/footer.php'; ?>
