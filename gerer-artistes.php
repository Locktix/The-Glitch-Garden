<?php
require_once 'app/database/database.php';
use App\Database\Database;

$pdo = Database::getPDO();

$req = $pdo->prepare("SELECT id, nom_artiste, prenom, nom FROM utilisateurs WHERE est_organisateur = FALSE ORDER BY nom_artiste");
$req->execute();
$artistes = $req->fetchAll(PDO::FETCH_ASSOC);

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
                    <td><?php echo htmlspecialchars($artiste['nom_artiste'] ?? '-'); ?></td>
                    <td><?php echo htmlspecialchars($artiste['prenom'] . ' ' . $artiste['nom']); ?></td>
                    <td><a href="gerer-artiste.php?id=<?php echo $artiste['id']; ?>" class="btn">Gérer</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php include 'app/view/footer.php'; ?>
