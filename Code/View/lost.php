<?php
/**
 * Project                  TPI - Application web pour la gestion des repas en lien avec les commissions et le budget
 * @file                    lost.php
 * @brief                   This file is designed to display that something went wrong
 * @author                  Created by Timothée RAPIN
 * Date de création         09.05.2023
 * update                   09.05.2023
 * @version                 0.1
 */

// Start output buffering
ob_start();

// Define the title of the page
$title = "Application web pour la gestion des repas en lien avec les commissions et le budget - 404";
?>

<!-- Page content -->
<main id="page" class="container">
    <h1>Page non trouvée</h1>
    <p>
        La page que vous avez demandée n'existe pas.
    </p>
    <p>
        <a href="index.php?action=home">
            Retour à l'accueil
        </a>
    </p>
</main>

<?php
// Store the buffered content in a variable
$content = ob_get_clean();

// Require the layout file 'gabarit.php'
require 'gabarit.php';
?>