/**
 * Project                  TPI - Application web pour la gestion des repas en lien avec les commissions et le budget
 * @file                    dataSigns.sql
 * @brief                   Ce fichier est conçu pour ajouter des données dans la table "signs" s'ils n'existent pas déjà
 * @author                  Créé par Timothée RAPIN
 * Date de création         23.05.2023
 * Date de mise à jour      23.05.2023
 * @version                 1.0
 */
 
 
# Selection de la DB
USE gesrep_trn_TPI;


# Ajouter des enseignes uniquement s'ils n'existent pas déjà
INSERT INTO signs (name)
SELECT 'Aligro'
WHERE NOT EXISTS (SELECT 1 FROM signs WHERE name = 'Aligro');

INSERT INTO signs (name)
SELECT 'Aldi'
WHERE NOT EXISTS (SELECT 1 FROM signs WHERE name = 'Aldi');

INSERT INTO signs (name)
SELECT 'Coop'
WHERE NOT EXISTS (SELECT 1 FROM signs WHERE name = 'Coop');

INSERT INTO signs (name)
SELECT 'Denner'
WHERE NOT EXISTS (SELECT 1 FROM signs WHERE name = 'Denner');

INSERT INTO signs (name)
SELECT 'Globus'
WHERE NOT EXISTS (SELECT 1 FROM signs WHERE name = 'Globus');

INSERT INTO signs (name)
SELECT 'Landi'
WHERE NOT EXISTS (SELECT 1 FROM signs WHERE name = 'Landi');

INSERT INTO signs (name)
SELECT 'Lidl'
WHERE NOT EXISTS (SELECT 1 FROM signs WHERE name = 'Lidl');

INSERT INTO signs (name)
SELECT 'Manor Food'
WHERE NOT EXISTS (SELECT 1 FROM signs WHERE name = 'Manor Food');

INSERT INTO signs (name)
SELECT 'Migros'
WHERE NOT EXISTS (SELECT 1 FROM signs WHERE name = 'Migros');

INSERT INTO signs (name)
SELECT 'Prima'
WHERE NOT EXISTS (SELECT 1 FROM signs WHERE name = 'Prima');

INSERT INTO signs (name)
SELECT 'Proxi'
WHERE NOT EXISTS (SELECT 1 FROM signs WHERE name = 'Proxi');

INSERT INTO signs (name)
SELECT 'Uniprix'
WHERE NOT EXISTS (SELECT 1 FROM signs WHERE name = 'Uniprix');

INSERT INTO signs (name)
SELECT 'Volg'
WHERE NOT EXISTS (SELECT 1 FROM signs WHERE name = 'Volg');


# affichage du résultat
SELECT * FROM gesrep_trn_TPI.signs;