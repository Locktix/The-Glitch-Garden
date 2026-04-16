<?php
	$page = 'inscription';
	include 'app/view/header.php';

    require_once 'app/Database/Database.php';

    use app\database\database;

    try {
        $pdo = Database::getPDO();
        echo "Connexion réussie à la base de données !";

    } catch (PDOException $e) {
        echo "Erreur de connexion : " . $e->getMessage();
    }

	$lastname = '';
	$firstname = '';
	$artistname = '';
	$photo = '';
	$bio = '';
	$email = '';
	$password = '';
	$confirm_password = '';
	$lastnameError = false;
	$firstnameError = false;
	$artistnameError = false;
	$photoError = false;
	$bioError = false;
	$emailError = false;
	$passwordError = false;
	$confirmPasswordError = false;

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$lastname = htmlspecialchars($_POST['lastname'] ?? '');
		$firstname = htmlspecialchars($_POST['firstname'] ?? '');
		$artistname = htmlspecialchars($_POST['artistname'] ?? '');
		$photo = htmlspecialchars($_FILES['photo']['name'] ?? '');
		$bio = htmlspecialchars($_POST['bio'] ?? '');
		$email = htmlspecialchars($_POST['email'] ?? '');
		$password = $_POST['password'] ?? '';
		$confirm_password = $_POST['confirm_password'] ?? '';

		// Validation des champs
		if (empty($lastname)) {
			$lastnameError = true;
		}

		if (empty($firstname)) {
			$firstnameError = true;
		}

		if (empty($artistname)) {
			$artistnameError = true;
		}

		if (empty($photo)) {
			$photoError = true;
		}

		if (empty($bio)) {
			$bioError = true;
		}

		if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$emailError = true;
		}

		if (empty($password)) {
			$passwordError = true;
		}

		if ($password !== $confirm_password) {
			$confirmPasswordError = true;
		}
	}
	
?>
		<section class="register-section">
			<h1>Inscription</h1>
			<form action="" method="post" class="register-form">
				<?php if ($lastnameError): ?>			<span class="error-message">Veuillez entrer un nom valide.</span>				<?php endif; ?>
				<?php if ($firstnameError): ?>			<span class="error-message">Veuillez entrer un prénom valide.</span>			<?php endif; ?>
				<?php if ($artistnameError): ?>			<span class="error-message">Veuillez entrer un nom d'artiste valide.</span>		<?php endif; ?>
				<?php if ($photoError): ?>				<span class="error-message">Veuillez entrer une photo valide.</span>			<?php endif; ?>
				<?php if ($bioError): ?>				<span class="error-message">Veuillez entrer une biographie valide.</span>		<?php endif; ?>
				<?php if ($emailError): ?>				<span class="error-message">Veuillez entrer une adresse e-mail valide.</span>	<?php endif; ?>
				<?php if ($passwordError): ?>			<span class="error-message">Veuillez entrer un mot de passe valide.</span>		<?php endif; ?>
				<?php if ($confirmPasswordError): ?>	<span class="error-message">Les mots de passe ne correspondent pas.</span>		<?php endif; ?>

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
				<input type="password" id="password" name="password" required>

				<label for="confirm_password">Confirmation du mot de passe :</label>
				<input type="password" id="confirm_password" name="confirm_password" required>

				<button type="submit">S'inscrire</button>
				<div class="form-links">
					<a href="connexion.php" id="already-registered">Déjà inscrit ?</a>
				</div>
			</form>
		</section>
<?php 
include 'app/view/footer.php';
?>