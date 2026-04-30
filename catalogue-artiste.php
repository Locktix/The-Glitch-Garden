<?php
require_once 'app/database/database.php';
use App\Database\Database;

$ARTISTE_ID = 2; // Cyber pulse — utilisateur fixe en dur

$pdo = Database::getPDO();

$req = $pdo->prepare("
    SELECT p.id, p.titre, c.nom AS categorie,
           CASE WHEN pr.id IS NOT NULL THEN 1 ELSE 0 END AS est_programmee
    FROM prestations p
    JOIN categories c ON c.id = p.categorie_id
    LEFT JOIN programmation pr ON pr.prestation_id = p.id
    WHERE p.artiste_id = :id
    ORDER BY p.titre ASC
");
$req->execute([':id' => $ARTISTE_ID]);
$prestations = $req->fetchAll(PDO::FETCH_ASSOC);

$succes = isset($_GET['succes']) ? $_GET['succes'] : '';

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
