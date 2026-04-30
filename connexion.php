<?php
$page         = 'connexion';
$emailError   = false;
$passwordError = false;
$email        = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($_POST['email']    ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = true;
    }

    if (empty($password)) {
        $passwordError = true;
    }
}

include 'app/view/header.php';
?>

<section class="login-section">
    <h1>Connexion</h1>
    <form action="" method="post" class="login-form">

        <?php if ($emailError): ?>
            <span class="field-error">Veuillez entrer une adresse e-mail valide.</span>
        <?php endif; ?>
        <?php if ($passwordError): ?>
            <span class="field-error">Veuillez entrer votre mot de passe.</span>
        <?php endif; ?>

        <label for="email">Adresse e-mail :</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>

        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Se connecter</button>

        <div class="form-links">
            <a href="inscription.php">Pas encore inscrit ?</a>
        </div>
    </form>
</section>

<?php include 'app/view/footer.php'; ?>
