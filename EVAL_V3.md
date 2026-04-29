# EVAL_V3 — The Glitch Garden
**Échéance : 30 avril 2026 à 23h55**

---

## Base de données

- [ ] Créer le script SQL de création des tables (utilisateurs, prestations, scènes, catégories, programmation)
- [ ] Insérer un jeu de données de test (artistes, prestations, scènes, catégories, 1 organisateur, 1 artiste)
- [ ] Créer la connexion PDO à la base de données (fichier de config)
- [ ] Vérifier que toutes les requêtes SQL utilisent des requêtes préparées (PDO prepared statements)

---

## Architecture PHP

- [ ] Installer Composer + PHPMailer
- [ ] Remplacer "Se connecter" dans le menu par "Dashboard Organisateur" et "Dashboard Artiste"

---

## Groupe A — Fonctionnalités Publiques

- [ ] **UC-A.4** — Grille horaire dynamique depuis la BDD
  - [ ] Colonnes = scènes, lignes = créneaux horaires
  - [ ] Afficher uniquement les heures où au moins une prestation est programmée
  - [ ] Chaque cellule = titre + nom artiste, lien cliquable vers détail prestation
  - [ ] Message si aucune prestation programmée

- [ ] **UC-A.5** — Liste des artistes dynamique depuis la BDD
  - [ ] Vignettes : photo, nom, créneaux de l'artiste si programmé
  - [ ] Filtre "Afficher uniquement les artistes programmés"
  - [ ] Message si aucun artiste ne correspond

- [ ] **UC-A.6** — Détail d'un artiste dynamique depuis la BDD
  - [ ] Infos complètes (nom, prénom, nom artiste, photo, biographie)
  - [ ] Liste de toutes ses prestations avec vignettes (titre, image, heure+scène si programmée)
  - [ ] Redirection avec message d'erreur si l'artiste n'existe pas

- [ ] **UC-A.7** — Catalogue des prestations dynamique depuis la BDD
  - [ ] Recherche par mot-clé (sur le titre ET la description)
  - [ ] Filtre par artiste (liste déroulante)
  - [ ] Filtre par catégorie (liste déroulante)
  - [ ] Filtre "Uniquement les prestations programmées"
  - [ ] Message si aucune prestation ne correspond

- [ ] **UC-A.8** — Détail d'une prestation dynamique depuis la BDD
  - [ ] Titre, description, image, catégorie
  - [ ] Heure + scène si programmée
  - [ ] Lien cliquable vers le profil de l'artiste
  - [ ] Redirection avec message d'erreur si la prestation n'existe pas

- [ ] **UC-A.9** — Formulaire de contact avec PHPMailer
  - [ ] Envoi e-mail à l'organisateur + CC à l'expéditeur
  - [ ] Validation côté serveur (champs obligatoires, format e-mail)
  - [ ] Repopulation des champs en cas d'erreur
  - [ ] Erreurs visuelles sur les champs concernés
  - [ ] Message de confirmation après envoi

---

## Groupe B — Fonctionnalités Utilisateur Connecté

- [ ] **UC-B.1** — Éditer son profil personnel *(sans champ photo)*
  - [ ] Formulaire prérempli avec les données actuelles
  - [ ] Changer de mot de passe optionnel (champs vides = conserver l'ancien)
  - [ ] Validation : champs obligatoires, format e-mail, unicité e-mail, mots de passe identiques
  - [ ] Repopulation des champs en cas d'erreur (sauf mots de passe)
  - [ ] Erreurs visuelles sur les champs concernés

---

## Groupe C — Fonctionnalités Artiste

- [ ] **UC-C.4** — Tableau de bord artiste *(utilisateur fixe défini en dur dans le code)*
  - [ ] Résumé profil (nom artiste, photo)
  - [ ] Liste des prestations programmées (titre, heure, scène)
  - [ ] Message si non encore programmé
  - [ ] Lien "Éditer mon profil"
  - [ ] Lien "Gérer mon catalogue de prestations"

- [ ] **Page "Gérer mon catalogue"** — Liste des prestations de l'artiste avec actions
  - [ ] Bouton "Ajouter une prestation"
  - [ ] Bouton "Modifier" par prestation (→ UC-C.2)
  - [ ] Bouton "Supprimer" par prestation (→ UC-C.3)

- [ ] **UC-C.1** — Ajouter une prestation *(sans champ image)*
  - [ ] Champs : titre, description, catégorie (liste déroulante)
  - [ ] Validation côté serveur
  - [ ] Repopulation des champs en cas d'erreur
  - [ ] Erreurs visuelles sur les champs concernés

- [ ] **UC-C.2** — Modifier une prestation *(sans champ image)*
  - [ ] Formulaire prérempli avec les données actuelles
  - [ ] Validation côté serveur
  - [ ] Repopulation des champs en cas d'erreur
  - [ ] Erreurs visuelles sur les champs concernés

- [ ] **UC-C.3** — Supprimer une prestation
  - [ ] Bloquer la suppression si la prestation est dans le programme (message d'erreur)
  - [ ] Demande de confirmation avant suppression

---

## Groupe D — Fonctionnalités Organisateur

- [ ] **Tableau de bord organisateur** *(utilisateur fixe défini en dur dans le code)*
  - [ ] Grille horaire interactive du programme
  - [ ] Bouton "Planifier une prestation" *(UC-D.1 non requis pour EVAL_V3)*
  - [ ] Bouton "Déprogrammer" sur chaque prestation (→ UC-D.2)
  - [ ] Navigation vers "Gérer les Artistes" (→ UC-D.4)
  - [ ] Navigation vers "Éditer mon profil" (→ UC-B.1)

- [ ] **UC-D.2** — Déprogrammer une prestation
  - [ ] Confirmation avant suppression (message précis avec titre de la prestation)
  - [ ] Message de succès après suppression
  - [ ] Grille mise à jour

- [ ] **UC-D.4** — Gérer le profil ou le catalogue d'un artiste *(sans champs image/photo)*
  - [ ] Page "Gérer les Artistes" : liste de tous les artistes avec bouton "Gérer"
  - [ ] Page admin d'un artiste : formulaire édition profil + gestion catalogue
  - [ ] Mêmes validations que UC-B.1 et UC-C.1/C.2/C.3
  - [ ] Repopulation des champs en cas d'erreur
  - [ ] Erreurs visuelles sur les champs concernés
