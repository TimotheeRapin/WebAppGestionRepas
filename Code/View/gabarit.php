<?php
/**
 * Projet                   TPI - Application web pour la gestion des repas en lien avec les commissions et le budget
 * @file                    gabarit.php
 * @brief                   This file is designed to manage the navigation of the site
 * @author                  Created by Timothée RAPIN
 * Creation date            05.05.2021
 * update                   05.05.2021
 * @version                 0.1
 * @note                    Creation of this file
 */
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <!-- Specify the character encoding -->
        <meta charset=utf-8" />

        <!-- Specify the initial scale -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Page title -->
        <title></title>

        <!-- SEO keywords and description -->
        <meta name="keywords" content="TPI, gestion, repas, commissions, budget" />
        <meta name="description" content="Application web pour la gestion des repas en lien avec les commissions et le budget" />

        <!-- Link to CSS files -->
        <link rel="stylesheet" href="../View/Contents/CSS/reset.css" />
        <link rel="stylesheet" href="../View/Contents/CSS/style.css" />
        <link rel="icon" href="../View/Contents/Icons/favicon.png">
    </head>
    <body>
        <header>
            <nav>
                <nav>
                    <ul>
                        <li><a href="index.php?action=home">Accueil</a></li>
                        <?php if (isset($_SESSION['userType']) && $_SESSION['userType'] == 'User') : ?>
                            <li><a href="index.php?action=menusList">Liste des menus</a></li>
                            <li><a href="index.php?action=foodsList">Liste des Recettes</a></li>
                            <li><a href="index.php?action=shoppingList">Liste des commissions</a></li>
                        <?php elseif (isset($_SESSION['userType']) && $_SESSION['userType'] == 'Administrator') : ?>
                            <li><a href="index.php?action=usersList">Liste des utilisateurs</a></li>
                            <li><a href="index.php?action=foodsList">Liste des Recettes</a></li>
                            <li><a href="index.php?action=signsList">Liste des enseignes</a></li>
                            <li><a href="index.php?action=articlesList">Liste des articles</a></li>
                        <?php endif; ?>

                        <?php if (isset($_SESSION['userEmailAddress'])) : ?>
                        <ul>
                            <li><a href="index.php?action=userMange">Mon compte</a></li>
                            <li><a href="index.php?action=logout">Déconnexion</a></li>
                        </ul>
                        <?php else: ?>
                        <li><a href="index.php?action=login">Connexion</a></li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </nav>
        </header>

        <?php if (isset($content)) : ?>
            <!-- Input the content of the page -->
            <?=$content; ?>
        <?php else: ?>
            <!-- If the content could not be loaded, display an error message -->
            <main id="content" class="container">
                <p>Le contenu de la page n'a pas pu être chargé.</p>
            </main>
        <?php endif;?>

        <footer>
            <span>&copy; Untitled. All rights reserved. | Design by Timothée Rapin.</span>
        </footer>
    </body>
</html>