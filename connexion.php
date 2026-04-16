<?php
    $page = 'connexion';
    include 'app/view/header.php';

    $email = '';
    $emailError = false;
    $passwordError = false;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = htmlspecialchars($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailError = true;
        }

        if (empty($password)) {
            $passwordError = true;
        }
    }

?>
        <section class="login-section">
            <h1>Connexion</h1>
            <form action="" method="post" class="login-form">
                <label for="email">Adresse e-mail :</label>
                <?php if ($emailError): ?>
                    <span class="error-message">Veuillez entrer une adresse e-mail valide.</span>
                <?php endif; ?>

                <input type="email" id="email" name="email" value="<?= $email ?>" required>

                <label for="password">Mot de passe :</label>
                <?php if ($passwordError): ?>
                    <span class="error-message">Veuillez entrer votre mot de passe.</span>
                <?php endif; ?>
                <div class="password-container">
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit">Se connecter</button>
                <div class="form-links">
                    <a href="#" id="forgot-password">Mot de passe oublié ?</a>
                    <a href="inscription.php" id="create-account">Pas encore inscrit ?</a>
                </div>
            </form>
        </section>
<?php 
include 'app/view/footer.php';
?>