<?php
    $page = 'inscription';
    include 'app/view/header.php';

    $lastname = '';
    $firstname = '';
    $artistname = '';
    $photo = '';
    $bio = '';
    $email = '';
    $password = '';
    $confirm_password = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $lastname = htmlspecialchars($_POST['lastname'] ?? '');
        $firstname = htmlspecialchars($_POST['firstname'] ?? '');
        $artistname = htmlspecialchars($_POST['artistname'] ?? '');
        $photo = htmlspecialchars($_POST['photo'] ?? '');
        $bio = htmlspecialchars($_POST['bio'] ?? '');
        $email = htmlspecialchars($_POST['email'] ?? '');
        $password = htmlspecialchars($_POST['password'] ?? '');
        $confirm_password = htmlspecialchars($_POST['confirm_password'] ?? '');

        // Validation des champs
        if (empty($lastname)) {
            $lastnameIsValide = true;
        }

        if (empty($firstname)) {
            $firstnameIsValide = true;
        }

        if (empty($artistname)) {
            $artistnameIsValide = true;
        }

        if (empty($photo)) {
            $photoIsValide = true;
        }

        if (empty($bio)) {
            $bioIsValide = true;
        }

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailIsValide = true;
        }

        if (empty($password)) {
            $passwordIsValide = true;
        }

        if ($password === $confirm_password) {
            $confirmPasswordIsValide = true;
        }
    }

    
?>
        <section class="register-section">
            <h1>Inscription</h1>
            <form action="#" method="post" class="register-form">
                <label for="lastname">Nom :</label> 
                <input type="text" id="lastname" name="lastname" value="<?= $lastname; ?>" required>

                <label for="firstname">Prénom :</label>
                <input type="text" id="firstname" name="firstname" value="<?= $firstname; ?>" required>

                <label for="artistname">Nom d'artiste :</label>
                <input type="text" id="artistname" name="artistname" value="<?= $artistname; ?>" required>

                <label for="photo">Photo (URL ou Fichier) :</label>
                <input type="file" id="photo" name="photo" accept="image/jpeg, image/png" required>

                <label for="bio">Description / Biographie :</label>
                <textarea id="bio" name="bio" rows="4" required><?= $bio; ?></textarea>

                <label for="email">Adresse e-mail :</label>
                <input type="email" id="email" name="email" value="<?= $email; ?>" required>

                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" value="<?= $password; ?>" required>

                <label for="confirm_password">Confirmation du mot de passe :</label>
                <input type="password" id="confirm_password" name="confirm_password" value="<?= $confirm_password; ?>" required>

                <button type="submit">S'inscrire</button>
                <div class="form-links">
                    <a href="connexion.php" id="already-registered">Déjà inscrit ?</a>
                </div>
            </form>
        </section>
<?php 
include 'app/view/footer.php';
?>