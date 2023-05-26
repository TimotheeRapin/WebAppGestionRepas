<?php
/**
 * Project                  TPI - Application web pour la gestion des repas en lien avec les commissions et le budget
 * @file                    signsList.php
 * @brief                   This file is designed to display the signs list
 * @author                  Created by Timothée RAPIN
 * Creation date            11.05.2023
 * update                   11.05.2023
 * @version                 1.0
 * @note                    creation of the file
 */

// Start output buffering
ob_start();

// Define the title of the page
$title = 'Application web pour la gestion des repas en lien avec les commissions et le budget - Liste des enseignes';

?>

<!-- Page content -->

    <!-- Page content -->
    <main id="page" class="container">
        <h1>Liste des enseignes</h1>

        <table class="userList">
            <thead>
            <tr>
                <th>Nom</th>
                <!--
                <th>Modifier</th>
                -->
                <th>Supprimer</th>
            </tr>
            </thead>
            <?php foreach ($signs as $sign): ?>
                <tr>
                    <td><?=$sign['name']; ?></td>
                    <!--
                    <td>
                        <a href="index.php?action=signsUpdate&id=<?=$sign['id']; ?>">
                            <button>Modifier</button>
                        </a>
                    </td>
                    -->
                    <td>
                        <a href="index.php?action=signsDelete&id=<?=$sign['id']; ?>">
                            <button>Supprimer</button>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <a href="index.php?action=signsAdd">
            <button>Ajouter une enseigne</button>
        </a>
    </main>


<?php
// Store the buffered content in a variable
$content = ob_get_clean();

// Require the layout file 'gabarit.php'
require 'gabarit.php';
?>