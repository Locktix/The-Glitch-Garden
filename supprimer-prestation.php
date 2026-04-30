<?php
require_once 'app/database/database.php';
use App\Database\Database;

$pdo = Database::getPDO();

$id            = isset($_GET['id'])             ? (int)$_GET['id']             : 0;
$source        = isset($_GET['source'])         ? $_GET['source']              : 'artiste';
$sourceArtiste = isset($_GET['source_artiste']) ? (int)$_GET['source_artiste'] : 0;

$retour = ($source === 'organisateur' && $sourceArtiste > 0)
    ? 'gerer-artiste.php?id=' . $sourceArtiste
    : 'catalogue-artiste.php';

$reqP = $pdo->prepare("SELECT id, titre FROM prestations WHERE id = :id");
$reqP->execute([':id' => $id]);
$prestation = $reqP->fetch(PDO::FETCH_ASSOC);

if (!$prestation) {
    header('Location: ' . $retour);
    exit;
}

$reqProg = $pdo->prepare("SELECT id FROM programmation WHERE prestation_id = :id");
$reqProg->execute([':id' => $id]);
$estProgrammee = $reqProg->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$estProgrammee) {
    $del = $pdo->prepare("DELETE FROM prestations WHERE id = :id");
    $del->execute([':id' => $id]);
    header('Location: ' . $retour . '?succes=' . urlencode('Prestation supprimée avec succès.'));
    exit;
}

$page = 'supprimer-prestation';
include 'app/view/header.php';
?>

<a href="<?php echo $retour; ?>" class="back-link">&larr; Retour</a>
<h1 class="page-title">Supprimer une prestation</h1>

<?php if ($estProgrammee): ?>
    <div class="error-message">
        <p>Impossible de supprimer "<strong><?php echo htmlspecialchars($prestation['titre']); ?></strong>" car elle est actuellement dans le programme. Déprogrammez-la d'abord.</p>
    </div>
    <div class="form-actions">
        <a href="<?php echo $retour; ?>" class="btn btn-secondary">Retour</a>
    </div>
<?php else: ?>
    <p>Êtes-vous sûr de vouloir supprimer "<strong><?php echo htmlspecialchars($prestation['titre']); ?></strong>" ?</p>
    <p>Cette action est irréversible.</p>
    <form method="POST" action="supprimer-prestation.php?id=<?php echo $id; ?>&source=<?php echo htmlspecialchars($source); ?>&source_artiste=<?php echo $sourceArtiste; ?>">
        <div class="form-actions">
            <button type="submit" class="btn btn-danger">Oui, supprimer</button>
            <a href="<?php echo $retour; ?>" class="btn btn-secondary">Annuler</a>
        </div>
    </form>
<?php endif; ?>

<?php include 'app/view/footer.php'; ?>
