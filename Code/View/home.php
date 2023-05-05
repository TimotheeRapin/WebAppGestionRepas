<?php
/**
 * Project                  TPI - Application web pour la gestion des repas en lien avec les commissions et le budget
 * @file                    home.php
 * @brief                   This file is designed to display the home page of the site
 * @author                  Created by Timothée RAPIN
 * Creation date            05.05.2021
 * update                   05.05.2021
 * @version                 0.1
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
        Bienvenue sur l'application web pour la gestion des repas en lien avec les commissions et le budget.
    </p>
    <p>
        Cette plateforme permet de g^érer son budget en fonction des repas que l'on souhaite faire. <br>
        Elle gènère une liste de commissions en 2 types de listes. <br>
        Soit un liste pour l'enseigne la moin cher, soit avec les produits les moins cher, peut importe l'enseigne. <br>
    </p>
    <p>
        Il est possible de créer des menu avec les plats que l'on souhaite. <br>
        Pour chaque plat, il est possible de choisir le nombre de personne pour lequel le plat est prévu. <br>
    </p>
</main>

<?php
// Store the buffered content in a variable
$content = ob_get_clean();

// Require the layout file 'gabarit.php'
require 'gabarit.php';
?>