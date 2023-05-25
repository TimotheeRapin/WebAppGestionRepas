/**
 * Project                  TPI - Application web pour la gestion des repas en lien avec les commissions et le budget
 * @file                    dataFoods.sql
 * @brief                   Ce fichier est conçu pour ajouter des données dans la table "foods" s'ils n'existent pas déjà
 * @author                  Créé par Timothée RAPIN
 * Date de création         23.05.2023
 * Date de mise à jour      23.05.2023
 * @version                 1.0
 */
 
 /*
 nbPersons est toujours 1
 Types disponibles ('Starter', 'Dish', 'Dessert')
 */
 
 # Il faut d'abord créer les articles
 
# Selection de la DB
USE gesrep_trn_TPI;


# Ajout des entrées uniquement si elles n'existent pas déjà
INSERT INTO foods (name, nbPersons, difficulty, instruction, type)
SELECT 'Salade César', 1, 1, '1. Préparer la laitue et la romaine.<br>2. Ajouter des croûtons et du parmesan.<br>3. Verser la sauce César et mélanger.', 'Starter'
WHERE NOT EXISTS (SELECT 1 FROM foods WHERE name = 'Salade César');

INSERT INTO foods (name, nbPersons, difficulty, instruction, type)
SELECT 'Bruschetta', 1, 2, '1. Couper les tomates et les mozzarella en dés.<br>2. Mélanger les tomates, la mozzarella, l\'huile d\'olive et le basilic.<br>3. Étaler le mélange sur des tranches de pain grillé.', 'Starter'
WHERE NOT EXISTS (SELECT 1 FROM foods WHERE name = 'Bruschetta');

INSERT INTO foods (name, nbPersons, difficulty, instruction, type)
SELECT 'Salade de quinoa', 1, 2, '1. Cuire le quinoa selon les instructions.<br>2. Couper les légumes en dés.<br>3. Mélanger le quinoa et les légumes.<br>4. Assaisonner avec de l\'huile d\'olive et du jus de citron.', 'Starter'
WHERE NOT EXISTS (SELECT 1 FROM foods WHERE name = 'Salade de quinoa');

INSERT INTO foods (name, nbPersons, difficulty, instruction, type)
SELECT 'Soupe à l\'oignon', 1, 2, '1. Couper les oignons en tranches fines.<br>2. Faire revenir les oignons dans du beurre jusqu\'à ce qu\'ils soient dorés.<br>3. Ajouter le bouillon et laisser mijoter pendant 30 minutes.', 'Starter'
WHERE NOT EXISTS (SELECT 1 FROM foods WHERE name = 'Soupe à l\'oignon');

INSERT INTO foods (name, nbPersons, difficulty, instruction, type)
SELECT 'Avocado Toast', 1, 1, '1. Écraser l\'avocat avec une fourchette.<br>2. Tartiner l\'avocat écrasé sur des tranches de pain grillé.<br>3. Ajouter des épices ou des toppings selon vos préférences.', 'Starter'
WHERE NOT EXISTS (SELECT 1 FROM foods WHERE name = 'Avocado Toast');


# Ajout des plats uniquement s'ils n'existent pas déjà
INSERT INTO foods (name, nbPersons, difficulty, instruction, type)
SELECT 'Spaghetti à la bolognaise', 1, 1, '1. Faire bouillir les spaghetti.<br>2. Préparer la sauce bolognaise.<br>3. Mélanger les spaghetti avec la sauce bolognaise.', 'Dish'
WHERE NOT EXISTS (SELECT 1 FROM foods WHERE name = 'Spaghetti à la bolognaise');

INSERT INTO foods (name, nbPersons, difficulty, instruction, type)
SELECT 'Poulet rôti aux légumes', 1, 2, '1. Assaisonner le poulet avec des épices.<br>2. Disposer le poulet et les légumes sur une plaque de cuisson.<br>3. Cuire au four pendant 1 heure.', 'Dish'
WHERE NOT EXISTS (SELECT 1 FROM foods WHERE name = 'Poulet rôti aux légumes');

INSERT INTO foods (name, nbPersons, difficulty, instruction, type)
SELECT 'Risotto aux champignons', 1, 2, '1. Faire revenir les champignons dans du beurre.<br>2. Ajouter le riz et le bouillon progressivement en remuant.<br>3. Cuire jusqu\'à ce que le riz soit tendre et crémeux.', 'Dish'
WHERE NOT EXISTS (SELECT 1 FROM foods WHERE name = 'Risotto aux champignons');

INSERT INTO foods (name, nbPersons, difficulty, instruction, type)
SELECT 'Burger maison', 1, 2, '1. Préparer le steak haché et le cuire.<br>2. Toastez les pains à burger.<br>3. Assemblez le burger avec les ingrédients de votre choix.', 'Dish'
WHERE NOT EXISTS (SELECT 1 FROM foods WHERE name = 'Burger maison');

INSERT INTO foods (name, nbPersons, difficulty, instruction, type)
SELECT 'Pâtes carbonara', 1, 2, '1. Cuire les pâtes selon les instructions.<br>2. Faire revenir les lardons dans une poêle.<br>3. Mélanger les pâtes égouttées avec les lardons et la sauce carbonara.', 'Dish'
WHERE NOT EXISTS (SELECT 1 FROM foods WHERE name = 'Pâtes carbonara');


# Ajout des desserts uniquement s'ils n'existent pas déjà
INSERT INTO foods (name, nbPersons, difficulty, instruction, type)
SELECT 'Tarte aux pommes', 1, 2, '1. Préparer la pâte brisée.<br>2. Éplucher et couper les pommes.<br>3. Disposer les pommes sur la pâte et saupoudrer de sucre.<br>4. Cuire au four pendant 30 minutes.', 'Dessert'
WHERE NOT EXISTS (SELECT 1 FROM foods WHERE name = 'Tarte aux pommes');

INSERT INTO foods (name, nbPersons, difficulty, instruction, type)
SELECT 'Mousse au chocolat', 1, 2, '1. Faire fondre le chocolat au bain-marie.<br>2. Battre les blancs d\'œufs en neige ferme.<br>3. Incorporer délicatement le chocolat fondu aux blancs d\'œufs.<br>4. Mettre au réfrigérateur pendant quelques heures.', 'Dessert'
WHERE NOT EXISTS (SELECT 1 FROM foods WHERE name = 'Mousse au chocolat');

INSERT INTO foods (name, nbPersons, difficulty, instruction, type)
SELECT 'Crème brûlée', 1, 3, '1. Mélanger les jaunes d\'œufs, le sucre et la vanille.<br>2. Ajouter la crème et mélanger.<br>3. Verser dans des ramequins et cuire au four au bain-marie.<br>4. Réfrigérer et saupoudrer de sucre avant de caraméliser.', 'Dessert'
WHERE NOT EXISTS (SELECT 1 FROM foods WHERE name = 'Crème brûlée');

INSERT INTO foods (name, nbPersons, difficulty, instruction, type)
SELECT 'Tiramisu', 1, 2, '1. Mélanger le mascarpone, le sucre et les jaunes d\'œufs.<br>2. Tremper les biscuits dans du café.<br>3. Alterner les couches de biscuits et de crème mascarpone.<br>4. Saupoudrer de cacao en poudre.', 'Dessert'
WHERE NOT EXISTS (SELECT 1 FROM foods WHERE name = 'Tiramisu');

INSERT INTO foods (name, nbPersons, difficulty, instruction, type)
SELECT 'Gâteau au fromage', 1, 3, '1. Mélanger les biscuits émiettés et le beurre fondu pour faire la croûte.<br>2. Battre le fromage à la crème, le sucre et la vanille.<br>3. Ajouter les œufs un par un et battre jusqu\'à consistance lisse.<br>4. Verser la préparation sur la croûte et cuire au four.', 'Dessert'
WHERE NOT EXISTS (SELECT 1 FROM foods WHERE name = 'Gâteau au fromage');

SET FOREIGN_KEY_CHECKS = 0; -- Désactive la vérification des contraintes de clé étrangère

# Ajout des articles aux menus
-- Menu 1: Salade César
INSERT INTO foods_has_articles (foods_id, articles_id, quantity)
VALUES
    (1, 1, 1), -- Laitue
    (1, 2, 50), -- Croûtons
    (1, 3, 30), -- Parmesan
    (1, 6, 1), -- Huile d'olive
    (1, 7, 1); -- Basilic

-- Menu 2: Bruschetta
INSERT INTO foods_has_articles (foods_id, articles_id, quantity)
VALUES
    (2, 4, 150), -- Tomates
    (2, 5, 200), -- Mozzarella
    (2, 6, 1), -- Huile d'olive
    (2, 7, 1), -- Basilic
    (2, 8, 4); -- Pain


-- Menu 4: Soupe à l'oignon
INSERT INTO foods_has_articles (foods_id, articles_id, quantity)
VALUES
    (4, 11, 2), -- Oignons
    (4, 12, 1), -- Ail
    (4, 18, 1); -- Bouillon


SET FOREIGN_KEY_CHECKS = 1; -- Réactive la vérification des contraintes de clé étrangère

# affichage du résultat
SELECT * FROM gesrep_trn_TPI.foods;