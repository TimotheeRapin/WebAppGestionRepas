<?php
/**
 * Project                  TPI - Application web pour la gestion des repas en lien avec les commissions et le budget
 * @file                    home.php
 * @brief                   This file is designed to display the home page of the site
 * @author                  Created by Timothée RAPIN
 * Creation date            05.05.2021
 * update                   05.05.2021
 * @version                 1.1
 * @note                    Creation of this file
 */
// Start output buffering
ob_start();

// Define the title of the page
$title = 'Application web pour la gestion des repas en lien avec les commissions et le budget - Présentation';
?>

<!-- Page content -->
<main id="page" class="container">
    <h1>Accueil</h1>

    <p>
        Bienvenue!
    </p>
    <p>
        Cette plateforme vous permet de générer une liste de commissions la plus économique en fonction des prix dans chaque enseigne.<br>
        Il est possible de créer des menus avec les plats que l'on souhaite.<br>
        Pour chaque plat, il est possible de choisir le nombre de personnes pour lequel il est prévu.<br>
    </p>
</main>

<?php
// Store the buffered content in a variable
$content = ob_get_clean();

// Require the layout file 'gabarit.php'
require 'gabarit.php';
?>