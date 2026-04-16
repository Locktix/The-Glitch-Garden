<?php
    $page = 'connexion';
    include 'app/view/header.php';

    require_once 'app/Database/Database.php';

    use app\database\database;

    try {
        $pdo = Database::getPDO();
        echo "Connexion réussie à la base de données !";
    } catch (PDOException $e) {
        echo "Erreur de connexion : " . $e->getMessage();
    }


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
            <?php if ($emailError): ?>      <span class="error-message">Veuillez entrer une adresse e-mail valide.</span>   <?php endif; ?>
            <?php if ($passwordError): ?>   <span class="error-message">Veuillez entrer votre mot de passe.</span>          <?php endif; ?>
                
            <label for="email">Adresse e-mail :</label>
            <input type="email" id="email" name="email" value="<?= $email ?>" required>

            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>

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