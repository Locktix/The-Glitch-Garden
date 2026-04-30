<?php
require_once 'app/database/database.php';
use App\Database\Database;

$pdo = Database::getPDO();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$req = $pdo->prepare("
    SELECT pr.id, p.titre, TIME_FORMAT(pr.heure_debut, '%Hh%i') AS heure, s.nom AS scene
    FROM programmation pr
    JOIN prestations p ON p.id = pr.prestation_id
    JOIN scenes s      ON s.id = pr.scene_id
    WHERE pr.id = :id
");
$req->execute([':id' => $id]);
$creneau = $req->fetch(PDO::FETCH_ASSOC);

if (!$creneau) {
    header('Location: dashboard-organisateur.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $del = $pdo->prepare("DELETE FROM programmation WHERE id = :id");
    $del->execute([':id' => $id]);
    header('Location: dashboard-organisateur.php?succes=' . urlencode('Prestation déprogrammée avec succès.'));
    exit;
}

$page = 'deprogrammer-prestation';
include 'app/view/header.php';
?>

<a href="dashboard-organisateur.php" class="back-link">&larr; Retour au dashboard</a>
<h1 class="page-title">Déprogrammer une prestation</h1>

<p>Êtes-vous sûr de vouloir déprogrammer "<strong><?php echo htmlspecialchars($creneau['titre']); ?></strong>" prévu à <?php echo htmlspecialchars($creneau['heure']); ?> sur la <?php echo htmlspecialchars($creneau['scene']); ?> ?</p>
<p>La prestation ne sera pas supprimée, seulement retirée du programme.</p>

<form method="POST" action="deprogrammer-prestation.php?id=<?php echo $id; ?>">
    <div class="form-actions">
        <button type="submit" class="btn btn-danger">Oui, déprogrammer</button>
        <a href="dashboard-organisateur.php" class="btn btn-secondary">Annuler</a>
    </div>
</form>

<?php include 'app/view/footer.php'; ?>
