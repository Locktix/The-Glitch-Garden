-- ============================================
-- The Glitch Garden — Script de création BDD
-- ============================================

CREATE DATABASE IF NOT EXISTS glitch_garden;
USE glitch_garden;

-- --------------------------------------------
-- Tables sans dépendances en premier
-- --------------------------------------------

CREATE TABLE categories (
    id    INT AUTO_INCREMENT PRIMARY KEY,
    nom   VARCHAR(100) NOT NULL
);

CREATE TABLE scenes (
    id    INT AUTO_INCREMENT PRIMARY KEY,
    nom   VARCHAR(255) NOT NULL
);

CREATE TABLE utilisateurs (
    id               INT AUTO_INCREMENT PRIMARY KEY,
    nom              VARCHAR(255) NOT NULL,
    prenom           VARCHAR(255) NOT NULL,
    nom_artiste      VARCHAR(255),
    email            VARCHAR(255) NOT NULL UNIQUE,
    mot_de_passe     VARCHAR(255) NOT NULL,
    photo            VARCHAR(255),
    description      TEXT,
    est_organisateur BOOLEAN NOT NULL DEFAULT FALSE
);

-- --------------------------------------------
-- Tables avec dépendances
-- --------------------------------------------

CREATE TABLE prestations (
    id           INT AUTO_INCREMENT PRIMARY KEY,
    titre        VARCHAR(255) NOT NULL,
    description  TEXT,
    image        VARCHAR(255),
    categorie_id INT NOT NULL,
    artiste_id   INT NOT NULL,
    FOREIGN KEY (categorie_id) REFERENCES categories(id),
    FOREIGN KEY (artiste_id)   REFERENCES utilisateurs(id)
);

CREATE TABLE programmation (
    id            INT AUTO_INCREMENT PRIMARY KEY,
    prestation_id INT NOT NULL,
    scene_id      INT NOT NULL,
    heure_debut   TIME NOT NULL,
    FOREIGN KEY (prestation_id) REFERENCES prestations(id),
    FOREIGN KEY (scene_id)      REFERENCES scenes(id),
    UNIQUE (scene_id, heure_debut)
);
