<?php
require_once 'app/model/programmation.php';

use app\model\Programmation;

$ARTISTE_ID = 2; // Cyber pulse — utilisateur fixe en dur

$prestations = Programmation::getCatalogueArtiste($ARTISTE_ID);
$succes      = isset($_GET['succes']) ? $_GET['succes'] : '';

$page = 'catalogue-artiste';
include 'app/view/header.php';
?>

<a href="dashboard-artiste.php" class="back-link">&larr; Retour au dashboard</a>
<h1 class="page-title">Mon catalogue de prestations</h1>

<?php if ($succes): ?>
    <div class="succes-message"><?php echo htmlspecialchars($succes); ?></div>
<?php endif; ?>

<div class="form-actions">
    <a href="ajouter-prestation.php" class="btn">+ Ajouter une prestation</a>
</div>

<?php if (empty($prestations)): ?>
    <p class="no-results">Aucune prestation pour le moment.</p>
<?php else: ?>
    <table class="program-table">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Catégorie</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($prestations as $p): ?>
                <tr>
                    <td><a href="fiche-prestation.php?id=<?php echo $p['id']; ?>"><?php echo htmlspecialchars($p['titre']); ?></a></td>
                    <td><?php echo htmlspecialchars($p['categorie']); ?></td>
                    <td><?php echo $p['est_programmee'] ? 'Programmée' : 'Non programmée'; ?></td>
                    <td>
                        <a href="modifier-prestation.php?id=<?php echo $p['id']; ?>" class="btn">Modifier</a>
                        <a href="supprimer-prestation.php?id=<?php echo $p['id']; ?>" class="btn btn-danger">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php include 'app/view/footer.php'; ?>
