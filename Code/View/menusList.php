<?php
/**
 * Project                  TPI - Application web pour la gestion des repas en lien avec les commissions et le budget
 * @file                    menusList.php
 * @brief                   This file is designed to display the menus list
 * @authors                 Created by Timothée RAPIN
 * creation date            16.05.2023
 * update                   16.05.2023
 * version                  0.1
 * @note                    creation of the file
 */


// Start output buffering
ob_start();

// Define the title of the page
$title = 'Application web pour la gestion des repas en lien avec les commissions et le budget - Liste des recettes';

?>


<!-- Page content -->
<main id="page" class="container">
    <h1>Menus</h1>

    <?php foreach ($menus as $menu): ?>
        <h2><?=$menu['title']; ?></h2>
        <table>
            <tbody>
                <?php foreach ($menu['foods'] as $food): ?>
                    <?php if(isset($food['id'])): ?>
                        <tr>
                            <td>
                                <a href="index.php?action=foodDetails&id=<?=$food['id']; ?>">
                                    <?=$food['name']; ?>
                                </a>
                            </td>
                            <td>
                                <?=$food['nbPersons']; ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!--
                <tr>
                    <td><?=$food['name']; ?></td>
                    <td><?=$food['difficulty'] . " sur 3"; ?></td>

                    <td>
                        <a href="index.php?action=foodDetails&id=<?=$food['id']; ?>">
                            <button>Détails</button>
                        </a>
                    </td>
                </tr>-->

    <?php endforeach; ?>

    <a href="index.php?action=menusAdd">
        <button>Créer un menu</button>
    </a>
</main>


<?php
// Store the buffered content in a variable
$content = ob_get_clean();

// Require the layout file 'gabarit.php'
require 'gabarit.php';
?>