<?php
    $page = 'connexion';
    include 'app/view/header.php';

    $email = '';
    $password = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = htmlspecialchars($_POST['email'] ?? '');
        $password = htmlspecialchars($_POST['password'] ?? '');

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailIsValide = true;
        }

        if (empty($password)) {
            $passwordIsValide = true;
        }
    }

?>
        <section class="login-section">
            <h1>Connexion</h1>
            <form action="#" method="post" class="login-form">
                <label for="email">Adresse e-mail :</label>
                <input type="email" id="email" name="email" value="<?= $email ?>" required>

                <label for="password">Mot de passe :</label>
                <div class="password-container">
                    <input type="password" id="password" name="password" value="<?= $password ?>" required>
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