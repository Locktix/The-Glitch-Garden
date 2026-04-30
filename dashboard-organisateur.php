<?php
require_once 'app/database/database.php';
use App\Database\Database;

$ORGANISATEUR_ID = 1; // Alex Durand — utilisateur fixe en dur

$pdo    = Database::getPDO();
$scenes = ['Scène Principale', 'Temple Techno', 'Jardin Chillout'];
$programme = [];
$heures    = [];

$req = $pdo->prepare("
    SELECT
        pr.id                                AS programmation_id,
        TIME_FORMAT(pr.heure_debut, '%Hh%i') AS heure,
        s.nom                                AS scene,
        p.id                                 AS prestation_id,
        p.titre,
        u.nom_artiste                        AS artiste
    FROM programmation pr
    JOIN prestations p  ON p.id = pr.prestation_id
    JOIN scenes s       ON s.id = pr.scene_id
    JOIN utilisateurs u ON u.id = p.artiste_id
    ORDER BY pr.heure_debut ASC
");
$req->execute();
$rows = $req->fetchAll(PDO::FETCH_ASSOC);

foreach ($rows as $row) {
    $heure = $row['heure'];
    $scene = $row['scene'];
    if (!in_array($heure, $heures)) {
        $heures[] = $heure;
    }
    $programme[$heure][$scene] = $row;
}

$succes = $_GET['succes'] ?? '';

$page = 'dashboard-organisateur';
include 'app/view/header.php';
?>

<h1 class="page-title">Dashboard Organisateur</h1>

<?php if ($succes): ?>
    <div class="succes-message"><?php echo htmlspecialchars($succes); ?></div>
<?php endif; ?>

<div class="form-actions">
    <a href="profil.php?type=organisateur" class="btn">Éditer mon profil</a>
    <a href="gerer-artistes.php" class="btn">Gérer les Artistes</a>
    <a href="planifier-prestation.php" class="btn">Planifier une prestation</a>
</div>

<section class="program-section">
    <h2 class="section-title">Grille horaire du programme</h2>

    <?php if (empty($heures)): ?>
        <p class="no-results">Aucune prestation programmée.</p>
    <?php else: ?>
        <table class="program-table">
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
                                    <?php $item = $programme[$heure][$scene]; ?>
                                    <a href="fiche-prestation.php?id=<?php echo $item['prestation_id']; ?>">
                                        <?php echo htmlspecialchars($item['titre']); ?><br>
                                        <small><?php echo htmlspecialchars($item['artiste']); ?></small>
                                    </a><br>
                                    <a href="deprogrammer-prestation.php?id=<?php echo $item['programmation_id']; ?>" class="btn btn-danger" style="margin-top:0.4rem; font-size:0.8rem; padding:0.3rem 0.6rem;">Déprogrammer</a>
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
