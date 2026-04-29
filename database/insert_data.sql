-- ============================================
-- The Glitch Garden — Jeu de données de test
-- ============================================
-- Mot de passe de tous les comptes : password123
-- TODO : hasher les mots de passe plus tard avec password_hash() en PHP
-- ============================================

USE glitch_garden;

-- --------------------------------------------
-- Catégories
-- --------------------------------------------

INSERT INTO categories (nom) VALUES
    ('DJ Set'),
    ('Live Set'),
    ('Live Performance'),
    ('B2B Set');

-- id 1 = DJ Set
-- id 2 = Live Set
-- id 3 = Live Performance
-- id 4 = B2B Set

-- --------------------------------------------
-- Scènes
-- --------------------------------------------

INSERT INTO scenes (nom) VALUES
    ('Scène Principale'),
    ('Temple Techno'),
    ('Jardin Chillout');

-- id 1 = Scène Principale
-- id 2 = Temple Techno
-- id 3 = Jardin Chillout

-- --------------------------------------------
-- Utilisateurs
-- (1 organisateur + 7 artistes)
-- --------------------------------------------

INSERT INTO utilisateurs (nom, prenom, nom_artiste, email, mot_de_passe, photo, description, est_organisateur) VALUES
    -- Organisateur (id 1)
    (
        'Durand',
        'Alex',
        NULL,
        'orga@glitchgarden.be',
        'password123',
        NULL,
        'Organisateur du festival The Glitch Garden.',
        TRUE
    ),
    -- Cyber pulse (id 2)
    (
        'Dupont',
        'Antoine',
        'Cyber pulse',
        'cyberpulse@glitchgarden.be',
        'password123',
        'assets/img/artistes/cyber_pulse.jpg',
        'Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus voluptates quas alias praesentium quod. Accusamus, illo.',
        FALSE
    ),
    -- Deep harmony (id 3)
    (
        'Martin',
        'Sophie',
        'Deep harmony',
        'deepharmony@glitchgarden.be',
        'password123',
        'assets/img/artistes/deep_harmony.jpg',
        'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ipsa veritatis inventore laborum. Optio voluptas deleniti rerum consequuntur sus',
        FALSE
    ),
    -- Glitch master (id 4)
    (
        'Bernard',
        'Lucas',
        'Glitch master',
        'glitchmaster@glitchgarden.be',
        'password123',
        'assets/img/artistes/glitch_master.jpg',
        'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quia voluptate, debitis voluptatibus delectus faci',
        FALSE
    ),
    -- Luna sync (id 5)
    (
        'Leroy',
        'Emma',
        'Luna sync',
        'lunasync@glitchgarden.be',
        'password123',
        'assets/img/artistes/luna_sync.jpg',
        'Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur earum sapiente quibusdam voluptatum, natus eligendi temporibus.',
        FALSE
    ),
    -- NEXUS (id 6)
    (
        'Moreau',
        'Thomas',
        'NEXUS',
        'nexus@glitchgarden.be',
        'password123',
        'assets/img/artistes/NEXUS.jpg',
        'Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis quidem pariatur accusantium doloremque voluptates quos repellat.',
        FALSE
    ),
    -- Wave motion (id 7)
    (
        'Dubois',
        'Julie',
        'Wave motion',
        'wavemotion@glitchgarden.be',
        'password123',
        'assets/img/artistes/wave_motion.svg',
        'Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis inventore laudantium cumque quisquam aspernatur mollitia veritatis.',
        FALSE
    ),
    -- Dj Snake (id 8) — non programmé
    (
        'Smith',
        'William',
        'Dj Snake',
        'djsnake@glitchgarden.be',
        'password123',
        'assets/img/artistes/dj_snake.jpg',
        'Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus voluptates quas alias praesentium quod. Accusamus, illo.',
        FALSE
    );

-- --------------------------------------------
-- Prestations
-- categorie_id : 1=DJ Set, 2=Live Set, 3=Live Performance, 4=B2B Set
-- artiste_id   : 2=Cyber pulse, 3=Deep harmony, 4=Glitch master,
--                5=Luna sync, 6=NEXUS, 7=Wave motion, 8=Dj Snake
-- --------------------------------------------

INSERT INTO prestations (titre, description, image, categorie_id, artiste_id) VALUES
    -- id 1
    (
        'Drum & Bass Grooves',
        'Un voyage au cœur du Drum & Bass avec des rythmes percutants et des basses profondes.',
        'assets/img/scenes/temple_techno.jpg',
        1, 7
    ),
    -- id 2
    (
        'Ambient Morning Flow',
        'Une expérience sonore apaisante pour commencer la journée en douceur.',
        'assets/img/scenes/jardin_chillout.jpg',
        2, 5
    ),
    -- id 3
    (
        'Warm-up: Deep House',
        'Un set Deep House pour chauffer la foule avant les grosses têtes d''affiche.',
        'assets/img/scenes/main_stage_set.jpg',
        1, 3
    ),
    -- id 4
    (
        'Reggae/Dub Sessions',
        'Des vibrations reggae et dub pour une ambiance détendue et ensoleillée.',
        'assets/img/scenes/jardin_chillout.jpg',
        1, 4
    ),
    -- id 5
    (
        'Hard Groove Set',
        'Un set puissant mêlant techno industrielle et grooves hypnotiques.',
        'assets/img/scenes/temple_techno.jpg',
        1, 6
    ),
    -- id 6
    (
        'Live Synthwave Pop',
        'Une performance live alliant synthétiseurs analogiques et mélodies pop électroniques.',
        'assets/img/scenes/main_stage_set.jpg',
        3, 2
    ),
    -- id 7
    (
        'Acid Live Performance',
        'Une performance live acide et expérimentale qui repousse les limites de la techno.',
        'assets/img/scenes/temple_techno.jpg',
        3, 3
    ),
    -- id 8 — B2B attribué à Cyber pulse (artiste principal)
    (
        'Warm-up: Back to Back',
        'Un B2B explosif entre Cyber pulse et Wave motion pour clôturer la soirée en beauté.',
        'assets/img/scenes/main_stage_set.jpg',
        4, 2
    ),
    -- id 9 — non programmée
    (
        'Neon Drift Experience',
        'Une expérience immersive mêlant trance et visuels néon pour une nuit inoubliable.',
        'assets/img/scenes/main_stage_set.jpg',
        3, 5
    ),
    -- id 10 — non programmée
    (
        'Industrial Chaos',
        'Un set techno industriel chaotique et sans compromis pour les amateurs de sons extrêmes.',
        'assets/img/scenes/temple_techno.jpg',
        1, 6
    );

-- --------------------------------------------
-- Programmation
-- prestation_id : voir table prestations
-- scene_id      : 1=Scène Principale, 2=Temple Techno, 3=Jardin Chillout
-- UNIQUE (scene_id, heure_debut) garanti par la BDD
-- --------------------------------------------

INSERT INTO programmation (prestation_id, scene_id, heure_debut) VALUES
    (1, 2, '10:00:00'),  -- Drum & Bass Grooves       → Temple Techno      10h
    (2, 3, '10:00:00'),  -- Ambient Morning Flow       → Jardin Chillout   10h
    (3, 1, '11:00:00'),  -- Warm-up: Deep House        → Scène Principale  11h
    (4, 3, '11:00:00'),  -- Reggae/Dub Sessions        → Jardin Chillout   11h
    (5, 2, '13:00:00'),  -- Hard Groove Set            → Temple Techno     13h
    (6, 1, '14:00:00'),  -- Live Synthwave Pop         → Scène Principale  14h
    (7, 2, '14:00:00'),  -- Acid Live Performance      → Temple Techno     14h
    (8, 1, '19:00:00');  -- Warm-up: Back to Back      → Scène Principale  19h
