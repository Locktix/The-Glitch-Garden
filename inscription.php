<?php
require_once 'app/database/database.php';
use App\Database\Database;

$page     = 'inscription';
$erreurs  = [];
$lastname = '';
$firstname = '';
$artistname = '';
$bio      = '';
$email    = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $lastname   = trim($_POST['lastname']   ?? '');
    $firstname  = trim($_POST['firstname']  ?? '');
    $artistname = trim($_POST['artistname'] ?? '');
    $bio        = trim($_POST['bio']        ?? '');
    $email      = trim($_POST['email']      ?? '');
    $password   = $_POST['password']         ?? '';
    $confirm    = $_POST['confirm_password'] ?? '';

    if ($lastname === '')   $erreurs['lastname']   = 'Le nom est obligatoire.';
    if ($firstname === '')  $erreurs['firstname']  = 'Le prénom est obligatoire.';
    if ($artistname === '') $erreurs['artistname'] = "Le nom d'artiste est obligatoire.";
    if ($bio === '')        $erreurs['bio']        = 'La biographie est obligatoire.';
    if ($email === '') {
        $erreurs['email'] = "L'e-mail est obligatoire.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreurs['email'] = "Format d'e-mail invalide.";
    } else {
        $pdo   = Database::getPDO();
        $check = $pdo->prepare("SELECT id FROM utilisateurs WHERE email = :email");
        $check->execute([':email' => $email]);
        if ($check->fetch()) {
            $erreurs['email'] = "Cet e-mail est déjà utilisé.";
        }
    }
    if ($password === '') {
        $erreurs['password'] = 'Le mot de passe est obligatoire.';
    } elseif ($password !== $confirm) {
        $erreurs['confirm'] = 'Les mots de passe ne correspondent pas.';
    }

    if (empty($erreurs)) {
        $pdo = Database::getPDO();
        $req = $pdo->prepare("INSERT INTO utilisateurs (nom, prenom, nom_artiste, description, email, mot_de_passe, est_organisateur) VALUES (:nom, :prenom, :na, :bio, :email, :mdp, FALSE)");
        $req->execute([
            ':nom'    => $lastname,
            ':prenom' => $firstname,
            ':na'     => $artistname,
            ':bio'    => $bio,
            ':email'  => $email,
            ':mdp'    => $password,
        ]);
        header('Location: connexion.php');
        exit;
    }
}

include 'app/view/header.php';
?>

<section class="register-section">
    <h1>Inscription</h1>
    <form action="" method="post" class="register-form">

        <div class="form-group">
            <label for="lastname">Nom *</label>
            <input type="text" id="lastname" name="lastname" value="<?php echo htmlspecialchars($lastname); ?>" <?php echo isset($erreurs['lastname']) ? 'class="input-error"' : ''; ?>>
            <?php if (isset($erreurs['lastname'])): ?><span class="field-error"><?php echo $erreurs['lastname']; ?></span><?php endif; ?>
        </div>

        <div class="form-group">
            <label for="firstname">Prénom *</label>
            <input type="text" id="firstname" name="firstname" value="<?php echo htmlspecialchars($firstname); ?>" <?php echo isset($erreurs['firstname']) ? 'class="input-error"' : ''; ?>>
            <?php if (isset($erreurs['firstname'])): ?><span class="field-error"><?php echo $erreurs['firstname']; ?></span><?php endif; ?>
        </div>

        <div class="form-group">
            <label for="artistname">Nom d'artiste *</label>
            <input type="text" id="artistname" name="artistname" value="<?php echo htmlspecialchars($artistname); ?>" <?php echo isset($erreurs['artistname']) ? 'class="input-error"' : ''; ?>>
            <?php if (isset($erreurs['artistname'])): ?><span class="field-error"><?php echo $erreurs['artistname']; ?></span><?php endif; ?>
        </div>

        <div class="form-group">
            <label for="bio">Biographie *</label>
            <textarea id="bio" name="bio" rows="4" <?php echo isset($erreurs['bio']) ? 'class="input-error"' : ''; ?>><?php echo htmlspecialchars($bio); ?></textarea>
            <?php if (isset($erreurs['bio'])): ?><span class="field-error"><?php echo $erreurs['bio']; ?></span><?php endif; ?>
        </div>

        <div class="form-group">
            <label for="email">Adresse e-mail *</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" <?php echo isset($erreurs['email']) ? 'class="input-error"' : ''; ?>>
            <?php if (isset($erreurs['email'])): ?><span class="field-error"><?php echo $erreurs['email']; ?></span><?php endif; ?>
        </div>

        <div class="form-group">
            <label for="password">Mot de passe *</label>
            <input type="password" id="password" name="password" <?php echo isset($erreurs['password']) ? 'class="input-error"' : ''; ?>>
            <?php if (isset($erreurs['password'])): ?><span class="field-error"><?php echo $erreurs['password']; ?></span><?php endif; ?>
        </div>

        <div class="form-group">
            <label for="confirm_password">Confirmation du mot de passe *</label>
            <input type="password" id="confirm_password" name="confirm_password" <?php echo isset($erreurs['confirm']) ? 'class="input-error"' : ''; ?>>
            <?php if (isset($erreurs['confirm'])): ?><span class="field-error"><?php echo $erreurs['confirm']; ?></span><?php endif; ?>
        </div>

        <span class="form-note">* Champs obligatoires</span>

        <div class="form-actions">
            <button type="submit" class="btn">S'inscrire</button>
        </div>

        <div class="form-links">
            <a href="connexion.php">Déjà inscrit ?</a>
        </div>
    </form>
</section>

<?php include 'app/view/footer.php'; ?>
