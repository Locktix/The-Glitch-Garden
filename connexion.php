<?php
    $page = 'connexion';
    include 'app/View/header.php';
?>
        <section class="login-section">
            <h1>Connexion</h1>
            <form action="#" method="post" class="login-form">
                <label for="email">Adresse e-mail :</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Mot de passe :</label>
                <div class="password-container">
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit">Se connecter</button>
                <div class="form-links">
                    <a href="#" id="forgot-password">Mot de passe oublié ?</a>
                    <a href="inscription.html" id="create-account">Pas encore inscrit ?</a>
                </div>
            </form>
        </section>
<?php 
include 'app/View/footer.php';
?>