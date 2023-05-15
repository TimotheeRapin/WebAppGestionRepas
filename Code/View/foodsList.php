<?php
/**
 * Project                  TPI - Application web pour la gestion des repas en lien avec les commissions et le budget
 * @file                    foodsList.php
 * @brief                   This file is designed to display the receipts list
 * @author                  Created by Timothée RAPIN
 * Creation date            15.05.2023
 * update                   15.05.2023
 * @version                 1.0
 * @note                    Creation of this file
 */

// Start output buffering
ob_start();

// Define the title of the page
$title = 'Application web pour la gestion des repas en lien avec les commissions et le budget - Liste des recettes';

?>

<!-- Page content -->
<main id="page" class="container">
    <h1>Liste des recettes</h1>

    <h2>Entrées</h2>
    <table class="userList">
        <thead>
        <tr>
            <th>Nom</th>
            <!--
            <th>Temps</th>
            -->
            <th>Difficulté</th>
            <?php if (isset($_SESSION['userType']) && $_SESSION['userType'] == 'Administrator') : ?>
                <!--
                <th>Modifier</th>
                --><!--
                <th>Supprimer</th>
                -->
            <?php endif; ?>
        </tr>
        </thead>
        <?php foreach ($Starters as $food): ?>
            <tr>
                <td><?=$food['name']; ?></td>
                <!--
                <td><?=$food['time']; ?></td>
                -->
                <td><?=$food['difficulty'] . " sur 3"; ?></td>
                <?php if (isset($_SESSION['userType']) && $_SESSION['userType'] == 'Administrator') : ?>
                    <!--
                    <td>
                        <a href="index.php?action=articlesUpdate&id=<?=$food['id']; ?>">
                            <button>Modifier</button>
                        </a>
                    </td>
                    --><!--
                    <td>
                        <a href="index.php?action=articlesDelete&id=<?=$food['id']; ?>">
                            <button>Supprimer</button>
                        </a>
                    </td>-->
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Plats</h2>
    <table class="userList">
        <thead>
        <tr>
            <th>Nom</th>
            <!--
            <th>Temps</th>
            -->
            <th>Difficulté</th>
            <?php if (isset($_SESSION['userType']) && $_SESSION['userType'] == 'Administrator') : ?>
                <!--
                <th>Modifier</th>
                --><!--
                <th>Supprimer</th>
                -->
            <?php endif; ?>
        </tr>
        </thead>
        <?php foreach ($Dishs as $food): ?>
            <tr>
                <td><?=$food['name']; ?></td>
                <!--
                <td><?=$food['time']; ?></td>
                -->
                <td><?=$food['difficulty'] . " sur 3"; ?></td>
                <?php if (isset($_SESSION['userType']) && $_SESSION['userType'] == 'Administrator') : ?>
                    <!--
                    <td>
                        <a href="index.php?action=articlesUpdate&id=<?=$food['id']; ?>">
                            <button>Modifier</button>
                        </a>
                    </td>
                    --><!--
                    <td>
                        <a href="index.php?action=articlesDelete&id=<?=$food['id']; ?>">
                            <button>Supprimer</button>
                        </a>
                    </td>-->
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Desserts</h2>
    <table class="userList">
        <thead>
        <tr>
            <th>Nom</th>
            <!--
            <th>Temps</th>
            -->
            <th>Difficulté</th>
            <?php if (isset($_SESSION['userType']) && $_SESSION['userType'] == 'Administrator') : ?>
                <!--
                <th>Modifier</th>
                --><!--
                <th>Supprimer</th>
                -->
            <?php endif; ?>
        </tr>
        </thead>
        <?php foreach ($Desserts as $food): ?>
            <tr>
                <td><?=$food['name']; ?></td>
                <!--
                <td><?=$food['time']; ?></td>
                -->
                <td><?=$food['difficulty'] . " sur 3"; ?></td>
                <?php if (isset($_SESSION['userType']) && $_SESSION['userType'] == 'Administrator') : ?>
                    <!--
                    <td>
                        <a href="index.php?action=articlesUpdate&id=<?=$food['id']; ?>">
                            <button>Modifier</button>
                        </a>
                    </td>
                    --><!--
                    <td>
                        <a href="index.php?action=articlesDelete&id=<?=$food['id']; ?>">
                            <button>Supprimer</button>
                        </a>
                    </td>-->
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </table>

    <?php if (isset($_SESSION['userType']) && $_SESSION['userType'] == 'Administrator') : ?>
        <a href="index.php?action=foodsAdd">
            <button>Ajouter une recette</button>
        </a>
    <?php endif; ?>
</main>


<?php
// Store the buffered content in a variable
$content = ob_get_clean();

// Require the layout file 'gabarit.php'
require 'gabarit.php';
?>