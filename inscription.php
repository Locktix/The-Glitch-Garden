<?php
    $page = 'inscription';
    include 'app/View/header.php';
?>
        <section class="register-section">
            <h1>Inscription</h1>
            <form action="#" method="post" class="register-form">
                <label for="lastname">Nom :</label>
                <input type="text" id="lastname" name="lastname" required>

                <label for="firstname">Prénom :</label>
                <input type="text" id="firstname" name="firstname" required>

                <label for="artistname">Nom d'artiste :</label>
                <input type="text" id="artistname" name="artistname" required>

                <label for="photo">Photo (URL ou Fichier) :</label>
                <input type="file" id="photo" name="photo" accept="image/jpeg, image/png" required>

                <label for="bio">Description / Biographie :</label>
                <textarea id="bio" name="bio" rows="4" required></textarea>

                <label for="email">Adresse e-mail :</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>

                <label for="confirm_password">Confirmation du mot de passe :</label>
                <input type="password" id="confirm_password" name="confirm_password" required>

                <button type="submit">S'inscrire</button>
                <div class="form-links">
                    <a href="connexion.php" id="already-registered">Déjà inscrit ?</a>
                </div>
            </form>
        </section>
    </main>
<?php 
include 'app/View/footer.php';
?>