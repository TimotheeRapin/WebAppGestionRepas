/**
 * Project                  TPI - Application web pour la gestion des repas en lien avec les commissions et le budget
 * @file                    dataAccounts.sql
 * @brief                   Ce fichier est conçu pour ajouter des données dans la table "accounts" s'ils n'existent pas déjà
 * @author                  Créé par Timothée RAPIN
 * Date de création         23.05.2023
 * Date de mise à jour      23.05.2023
 * @version                 1.0
 */

# Tous les mots de passes sont : 1234

# Selection de la DB
USE gesrep_trn_TPI;


# Ajout des comptes administrateur
INSERT INTO accounts (firstName, lastName, email, password, type)
SELECT 'Timothee', 'RAPIN', 'timothee.rapin@cpnv.ch', '$2y$10$CYBxpUj6ak6gqKMP0TLeB.4tgYDIUL7hMW2EgakJSVeMejD/akmJS', 'Administrator'
WHERE NOT EXISTS (SELECT 1 FROM accounts WHERE email = 'timothee.rapin@cpnv.ch');

INSERT INTO accounts (firstName, lastName, email, password, type)
SELECT 'Gabriel', 'DUPUIS', 'gabriel@dupuis.ch', '$2y$10$ufu9BEQ1nwgxO80X47ENTuQDVIBWlRiUU2voTtt8DjtUSN.NU6TL.', 'Administrator'
WHERE NOT EXISTS (SELECT 1 FROM accounts WHERE email = 'gabriel@dupuis.ch');

INSERT INTO accounts (firstName, lastName, email, password, type)
SELECT 'Juliette', 'FORTIN', 'juliette@fortin.ch', '$2y$10$ucWx4Ik5TLG0dCJZkwe9hee1OQ6a5YgL2fOXtd0DzPi6Mw6MxSWjO', 'Administrator'
WHERE NOT EXISTS (SELECT 1 FROM accounts WHERE email = 'juliette@fortin.ch');

INSERT INTO accounts (firstName, lastName, email, password, type)
SELECT 'Martin', 'GAGNÉ', 'martin@gagne.ch', '$2y$10$Gabz0x69Ku.Yg4JpOQrkY.JGrmmhphZNztVBe5.3TW4hGpj01mFNO', 'Administrator'
WHERE NOT EXISTS (SELECT 1 FROM accounts WHERE email = 'martin@gagne.ch');


# Ajout des comptes utilisateur
INSERT INTO accounts (firstName, lastName, email, password, type)
SELECT 'Alice', 'MARTIN', 'alice@martin.ch', '$2y$10$wx5UaEbBaQQNBBbuWSSxHejzfgnQcGW.buwjh6UDneR54LDH35Lne', 'User'
WHERE NOT EXISTS (SELECT 1 FROM accounts WHERE email = 'alice@martin.ch');

INSERT INTO accounts (firstName, lastName, email, password, type)
SELECT 'Romain', 'LEROY', 'romain@leroy.ch', '$2y$10$sH7lVL3h7ikiCBOg6VEbcezHESKpbwnpu0bH9qDRQ9VJGhfDLo.iy', 'User'
WHERE NOT EXISTS (SELECT 1 FROM accounts WHERE email = 'romain@leroy.ch');

INSERT INTO accounts (firstName, lastName, email, password, type)
SELECT 'Marie', 'DUBOIS', 'marie@dubois.ch', '$2y$10$rCeRFFmp5jlfsyfKL73/C.kQdx7gTNtaItwYgzgSdj5Fsr2Uf23Lu', 'User'
WHERE NOT EXISTS (SELECT 1 FROM accounts WHERE email = 'marie@dubois.ch');

INSERT INTO accounts (firstName, lastName, email, password, type)
SELECT 'Thomas', 'ROUSSEAU', 'thomas@rousseau.ch', '$2y$10$p/GLhJrXzJ4jxMkwtbAis.C59pLfji7EvVtXF1fW/AXil.kuWWc26', 'User'
WHERE NOT EXISTS (SELECT 1 FROM accounts WHERE email = 'thomas@rousseau.ch');

INSERT INTO accounts (firstName, lastName, email, password, type)
SELECT 'Elise', 'FONTAINE', 'elise@fontaine.ch', '$2y$10$v5mGd1tOslCI/un0CsQQ.e0sLiKabfaJN25qqnTMLFODR3QwwHjIy', 'User'
WHERE NOT EXISTS (SELECT 1 FROM accounts WHERE email = 'elise@fontaine.ch');

INSERT INTO accounts (firstName, lastName, email, password, type)
SELECT 'Antoine', 'BERTRAND', 'antoine@bertran.ch', '$2y$10$6yngH7WYA4sz3rx5qXFqE.Jn.3HzmMCVSrnaVNzN08aVLpmlulb1O', 'User'
WHERE NOT EXISTS (SELECT 1 FROM accounts WHERE email = 'antoine@bertran.ch');

INSERT INTO accounts (firstName, lastName, email, password, type)
SELECT 'Julie', 'CARON', 'julie@caron.ch', '$2y$10$wJl1FW0qz/hd3cR4bkxhu.7N2JRKE7zi1LNv3dxVF/Vg6GpdyhEyW', 'User'
WHERE NOT EXISTS (SELECT 1 FROM accounts WHERE email = 'julie@caron.ch');

INSERT INTO accounts (firstName, lastName, email, password, type)
SELECT 'Maxime', 'LAMBERT', 'maxime@lambert.ch', '$2y$10$fZOFDQX7XMJlMoD6LJ3v1eECwKO3SQx8ChWzcBVOuacxRTsrkSsyG', 'User'
WHERE NOT EXISTS (SELECT 1 FROM accounts WHERE email = 'maxime@lambert.ch');


# affichage du résultat
SELECT * FROM gesrep_trn_TPI.accounts;