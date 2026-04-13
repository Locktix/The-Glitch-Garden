<?php
    $page = 'contact';
    include 'app/view/header.php';
?>
        <a href="index.php" class="back-link">&larr; Retour à l'accueil</a>

        <h1 class="page-title">Contacter l'organisateur</h1>
        <p class="page-description">Une question sur le festival ? Remplissez le formulaire ci-dessous. Une copie du message vous sera envoyée.</p>

        <section class="contact-container">
            <form action="send_contact.php" method="POST" class="contact-form">
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="nom">Votre nom *</label>
                        <input type="text" id="nom" name="nom" required placeholder="Ex: Jean Dupont">
                    </div>

                    <div class="form-group">
                        <label for="email">Votre adresse e-mail *</label>
                        <input type="email" id="email" name="email" required placeholder="nom@exemple.com">
                    </div>
                </div>

                <div class="form-group">
                    <label for="sujet">Sujet *</label>
                    <input type="text" id="sujet" name="sujet" required placeholder="Objet de votre demande">
                </div>

                <div class="form-group">
                    <label for="message">Message *</label>
                    <textarea id="message" name="message" rows="4" required placeholder="Comment pouvons-nous vous aider ?"></textarea>
                </div>

                <span class="form-note">* Champs obligatoires</span>

                <button type="submit" class="btn-submit">Envoyer le message</button>
            </form>
        </section>
<?php 
include 'app/view/footer.php';
?>