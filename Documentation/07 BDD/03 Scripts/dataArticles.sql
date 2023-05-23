/**
 * Project                  TPI - Application web pour la gestion des repas en lien avec les commissions et le budget
 * @file                    dataArticles.sql
 * @brief                   Ce fichier est conçu pour ajouter des données dans la table "articles" s'ils n'existent pas déjà
 * @author                  Créé par Timothée RAPIN
 * Date de création         23.05.2023
 * Date de mise à jour      23.05.2023
 * @version                 1.0
 */
 
 # unités disponibles ('g', 'kg', 'ml', 'cl', 'l', 'pce')
 
 
# Selection de la DB
USE gesrep_trn_TPI;


# Suppression des données déjà existantes avec l'id
SET FOREIGN_KEY_CHECKS = 0; -- Désactive la vérification des contraintes de clé étrangère
TRUNCATE TABLE foods_has_articles;
TRUNCATE TABLE articles;
SET FOREIGN_KEY_CHECKS = 1; -- Réactive la vérification des contraintes de clé étrangère

SELECT * FROM signs_has_articles;

# Ajout des articles
INSERT INTO articles (id, name, quantity, description, unity)
VALUES 
    (1, 'Laitue', 1, '', 'pce'),
    (2, 'Croûtons', 150, '', 'g'),
    (3, 'Parmesan', 120, '', 'g'),
    (4, 'Tomates', 300, '', 'g'),
    (5, 'Mozzarella', 400, '', 'g'),
    (6, 'Huile d olive', 1, '', 'l'),
    (7, 'Basilic', 1, '', 'pce'),
    (8, 'Pain', 380, '', 'g'),
    (9, 'Spaghetti', 1, '', 'kg'),
    (10, 'Viande hachée', 700, '', 'g'),
    (11, 'Oignon', 2, '', 'kg'),
    (12, 'Ail', 1, '', 'pce'),
    (13, 'Poulet', 500, '', 'g'),
    (14, 'Carottes', 500, '', 'g'),
    (15, 'Pommes de terre', 500, '', 'g'),
    (16, 'Courgettes', 500, '', 'g'),
    (17, 'Riz', 500, '', 'g'),
    (18, 'Bouillon', 1, '', 'pce'),
    (19, 'Steak haché', 500, '', 'g'),
    (20, 'Pains à burger', 4, '', 'pce'),
    (21, 'Fromage', 500, '', 'g'),
    (22, 'Œufs', 6, '', 'pce'),
    (23, 'Crème', 500, '', 'ml'),
    (24, 'Chocolat', 200, '', 'g'),
    (25, 'Sucre', 500, '', 'g'),
    (26, 'Vanille', 1, '', 'pce'),
    (27, 'Biscuits', 200, '', 'g'),
    (28, 'Café', 250, '', 'g'),
    (29, 'Cacao en poudre', 200, '', 'g'),
    (30, 'Fromage à la crème', 200, '', 'g'),
    (31, 'Beurre', 250, '', 'g');

# Ajout des prix de chaque article dans les différentes enseignes
INSERT INTO signs_has_articles (signs_id, articles_id, price)
VALUES
	# Laitue 
    (1, 1, 2.00),
    (2, 1, 2.30),
    (3, 1, 2.10),
    (4, 1, 2.20),
    (5, 1, 2.40),
    (6, 1, 2.50),
    (7, 1, 2.60),
    (8, 1, 2.70),
    (9, 1, 2.80),
    (10, 1, 2.90),
    (11, 1, 3.00),
    (12, 1, 3.10),
    (13, 1, 3.20),
    
    # Croutons
    (1, 2, 3.90),
    (2, 2, 4.10),
    (3, 2, 3.75),
    (4, 2, 3.80),
    (5, 2, 3.95),
    (6, 2, 2.95),
    (7, 2, 3.20),
    (8, 2, 3.90),
    (9, 2, 3.50),
    (10, 2, 3.40),
    (11, 2, 4.10),
    (12, 2, 3.80),
    (13, 2, 3.95),

    # Parmesan
    (1, 3, 2.90),
    (2, 3, 3.10),
    (3, 3, 2.75),
    (4, 3, 2.80),
    (5, 3, 2.95),
    (6, 3, 1.95),
    (7, 3, 2.20),
    (8, 3, 2.90),
    (9, 3, 2.50),
    (10, 3, 2.40),
    (11, 3, 3.10),
    (12, 3, 2.80),
    (13, 3, 2.95),

    # Tomates
    (1, 4, 3.95),
    (2, 4, 4.10),
    (3, 4, 3.75),
    (4, 4, 3.80),
    (5, 4, 3.95),
    (6, 4, 2.95),
    (7, 4, 3.20),
    (8, 4, 3.90),
    (9, 4, 3.50),
    (10, 4, 3.40),
    (11, 4, 4.10),
    (12, 4, 3.80),
    (13, 4, 3.95),

    # Mozzarella
    (1, 5, 2.30),
    (2, 5, 2.50),
    (3, 5, 2.15),
    (4, 5, 2.20),
    (5, 5, 2.35),
    (6, 5, 1.35),
    (7, 5, 1.60),
    (8, 5, 2.30),
    (9, 5, 1.90),
    (10, 5, 1.80),
    (11, 5, 2.50),
    (12, 5, 2.20),
    (13, 5, 2.35),

    # Huile d'olive
    (1, 6, 9.50),
    (2, 6, 14.95),
    (3, 6, 9.95),
    (4, 6, 10.50),
    (5, 6, 11.95),
    (6, 6, 9.95),
    (7, 6, 10.20),
    (8, 6, 9.90),
    (9, 6, 9.50),
    (10, 6, 9.40),
    (11, 6, 10.10),
    (12, 6, 9.80),
    (13, 6, 9.95),

    # Basilic
    (1, 7, 3.80),
    (2, 7, 4.10),
    (3, 7, 3.75),
    (4, 7, 3.80),
    (5, 7, 3.95),
    (6, 7, 2.95),
    (7, 7, 3.20),
    (8, 7, 3.90),
    (9, 7, 3.50),
    (10, 7, 3.40),
    (11, 7, 4.10),
    (12, 7, 3.80),
    (13, 7, 3.95),

    # Pain
    (1, 8, 2.80),
    (2, 8, 3.10),
    (3, 8, 2.75),
    (4, 8, 2.80),
    (5, 8, 2.95),
    (6, 8, 1.95),
    (7, 8, 2.20),
    (8, 8, 2.90),
    (9, 8, 2.50),
    (10, 8, 2.40),
    (11, 8, 3.10),
    (12, 8, 2.80),
    (13, 8, 2.95),

    # Spaghetti
    (1, 9, 1.40),
    (2, 9, 1.60),
    (3, 9, 1.25),
    (4, 9, 1.30),
    (5, 9, 1.45),
    (6, 9, 0.45),
    (7, 9, 0.70),
    (8, 9, 1.40),
    (9, 9, 1.00),
    (10, 9, 0.90),
    (11, 9, 1.60),
    (12, 9, 1.30),
    (13, 9, 1.45),

    # Viande hachée
    (1, 10, 11.20),
    (2, 10, 11.40),
    (3, 10, 11.05),
    (4, 10, 11.10),
    (5, 10, 11.25),
    (6, 10, 10.25),
    (7, 10, 10.50),
    (8, 10, 11.20),
    (9, 10, 10.80),
    (10, 10, 10.70),
    (11, 10, 11.40),
    (12, 10, 11.10),
    (13, 10, 11.25),

    # Oignons
    (1, 11, 2.95),
    (2, 11, 3.10),
    (3, 11, 2.75),
    (4, 11, 2.80),
    (5, 11, 2.95),
    (6, 11, 1.95),
    (7, 11, 2.20),
    (8, 11, 2.90),
    (9, 11, 2.50),
    (10, 11, 2.40),
    (11, 11, 3.10),
    (12, 11, 2.80),
    (13, 11, 2.95);
    
# affichage du résultat

SELECT articles.id, articles.name, articles.quantity, articles.description, articles.unity, signs.name AS signs, signs_has_articles.price
FROM articles
CROSS JOIN signs /* Permet de récupérer toutes les enseignes et ainsi avoir une colonne par enseigne même s il n y a pas de prix dans cete enseigne.
					Cela permet de faire un tableau avec toujours la m'ême valeur pour chaque enseignes et éviter les décalages.
					Sources : https://www.w3schools.com/mysql/mysql_join_cross.asp*/
LEFT JOIN signs_has_articles ON articles.id = signs_has_articles.articles_id 
AND signs.id = signs_has_articles.signs_id
ORDER BY articles.name ASC, signs.name ASC;