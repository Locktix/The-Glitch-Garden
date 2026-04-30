<?php
$page    = 'contact';
$erreurs = [];
$succes  = '';
$nom     = '';
$email   = '';
$sujet   = '';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom     = trim($_POST['nom']     ?? '');
    $email   = trim($_POST['email']   ?? '');
    $sujet   = trim($_POST['sujet']   ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($nom === '')    $erreurs['nom']    = 'Le nom est obligatoire.';
    if ($email === '') {
        $erreurs['email'] = "L'e-mail est obligatoire.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreurs['email'] = "Format d'e-mail invalide.";
    }
    if ($sujet === '')   $erreurs['sujet']   = 'Le sujet est obligatoire.';
    if ($message === '') $erreurs['message'] = 'Le message est obligatoire.';

    if (empty($erreurs)) {
        $succes  = "Votre message a bien été envoyé. Une copie vous a été envoyée à " . htmlspecialchars($email) . ".";
        $nom = $email = $sujet = $message = '';
    }
}

include 'app/view/header.php';
?>

<a href="index.php" class="back-link">&larr; Retour à l'accueil</a>
<h1 class="page-title">Contacter l'organisateur</h1>
<p class="page-description">Une question sur le festival ? Remplissez le formulaire ci-dessous. Une copie du message vous sera envoyée.</p>

<?php if ($succes): ?>
    <div class="succes-message"><?php echo $succes; ?></div>
<?php endif; ?>

<section class="contact-container">
    <form action="contact.php" method="POST" class="contact-form">

        <div class="form-row">
            <div class="form-group">
                <label for="nom">Votre nom *</label>
                <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($nom); ?>" <?php echo isset($erreurs['nom']) ? 'class="input-error"' : ''; ?>>
                <?php if (isset($erreurs['nom'])): ?><span class="field-error"><?php echo $erreurs['nom']; ?></span><?php endif; ?>
            </div>

            <div class="form-group">
                <label for="email">Votre adresse e-mail *</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" <?php echo isset($erreurs['email']) ? 'class="input-error"' : ''; ?>>
                <?php if (isset($erreurs['email'])): ?><span class="field-error"><?php echo $erreurs['email']; ?></span><?php endif; ?>
            </div>
        </div>

        <div class="form-group">
            <label for="sujet">Sujet *</label>
            <input type="text" id="sujet" name="sujet" value="<?php echo htmlspecialchars($sujet); ?>" <?php echo isset($erreurs['sujet']) ? 'class="input-error"' : ''; ?>>
            <?php if (isset($erreurs['sujet'])): ?><span class="field-error"><?php echo $erreurs['sujet']; ?></span><?php endif; ?>
        </div>

        <div class="form-group">
            <label for="message">Message *</label>
            <textarea id="message" name="message" rows="4" <?php echo isset($erreurs['message']) ? 'class="input-error"' : ''; ?>><?php echo htmlspecialchars($message); ?></textarea>
            <?php if (isset($erreurs['message'])): ?><span class="field-error"><?php echo $erreurs['message']; ?></span><?php endif; ?>
        </div>

        <span class="form-note">* Champs obligatoires</span>

        <div class="form-actions">
            <button type="submit" class="btn">Envoyer le message</button>
        </div>

    </form>
</section>

<?php include 'app/view/footer.php'; ?>
