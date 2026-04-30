<?php
require_once 'app/database/database.php';
use App\Database\Database;

$ARTISTE_ID = 2; // Cyber pulse — utilisateur fixe en dur

$pdo = Database::getPDO();

$req = $pdo->prepare("SELECT * FROM utilisateurs WHERE id = :id AND est_organisateur = FALSE");
$req->execute([':id' => $ARTISTE_ID]);
$artiste = $req->fetch(PDO::FETCH_ASSOC);

$reqProg = $pdo->prepare("
    SELECT p.id, p.titre, TIME_FORMAT(pr.heure_debut, '%Hh%i') AS heure, s.nom AS scene
    FROM prestations p
    JOIN programmation pr ON pr.prestation_id = p.id
    JOIN scenes s         ON s.id = pr.scene_id
    WHERE p.artiste_id = :id
    ORDER BY pr.heure_debut ASC
");
$reqProg->execute([':id' => $ARTISTE_ID]);
$performances = $reqProg->fetchAll(PDO::FETCH_ASSOC);

$page = 'dashboard-artiste';
include 'app/view/header.php';
?>

<h1 class="page-title">Dashboard Artiste</h1>

<div class="artist-profile-header">
    <?php if (!empty($artiste['photo'])): ?>
        <img src="<?php echo htmlspecialchars($artiste['photo']); ?>" alt="Photo de <?php echo htmlspecialchars($artiste['nom_artiste']); ?>" class="artist-photo">
    <?php endif; ?>
    <div class="artist-presentation">
        <span class="artist-real-name"><?php echo htmlspecialchars($artiste['prenom'] . ' ' . $artiste['nom']); ?></span>
        <h2><?php echo htmlspecialchars($artiste['nom_artiste'] ?? ''); ?></h2>
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
