<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="assets/img/logo.png">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>The Glitch Garden - Accueil</title>
</head>
<body>

    <header>
        <div class="centrage header-content">
            <a href="index.php"><img src="assets/img/logo.png" alt="Logo The Glitch Garden"></a>
            <a id="site-title" href="index.php">The Glitch Garden</a>
            <nav>
                <ul class="main-nav">
                    <li><a href="index.php" <?= ($page === 'accueil') ? 'id="current"' : '' ?>>Accueil</a></li>
                    <li><a href="prestations.php" <?= ($page === 'prestations') ? 'id="current"' : '' ?>>Prestations</a></li>
                    <li><a href="artistes.php" <?= ($page === 'artistes') ? 'id="current"' : '' ?>>Artistes</a></li>
                    <li><a href="contact.php" <?= ($page === 'contact') ? 'id="current"' : '' ?>>Contact</a></li>
                </ul>

                <ul>
                    <li><a href="connexion.php" <?= ($page === 'connexion') ? 'id="current"' : '' ?>>Se connecter</a></li>
                    <li><a href="inscription.php" <?= ($page === 'inscription') ? 'id="current"' : '' ?>>S'inscrire</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="centrage">