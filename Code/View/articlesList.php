<?php
/**
 * Project                  TPI - Application web de gestion de planning
 * @file                    articlesList.php
 * @brief                   This file is designed to display the articles list
 * @author                  Created by Timothée RAPIN
 * Creation date            11.05.2023
 * update                   11.05.2023
 * @version                 1.0
 * @note                    Creation of this file
 */



// Start output buffering
ob_start();

// Define the title of the page
$title = 'Application web pour la gestion des repas en lien avec les commissions et le budget - Liste des articles';

?>

    <!-- Page content -->

    <!-- Page content -->
    <main id="page" class="container">
        <h1>Liste des articles</h1>

        <table class="userList">
            <thead>
            <tr>
                <th rowspan="2">Nom</th>
                <th rowspan="2">Quantité</th>
                <th rowspan="2">Description</th>
                <!-- Prix par enseigne -->
                <?php foreach ($signs as $sign): ?>
                    <th> Prix (CHF)</th>
                <?php endforeach; ?>

                <!--
                <th>Modifier</th>
                -->
                <th rowspan="2">Supprimer</th>
            </tr>
            <tr>
                <!-- Prix par enseigne -->
                <?php foreach ($signs as $sign): ?>
                    <th><?=$sign['name']; ?></th>
                <?php endforeach; ?>
            </tr>
            </thead>
            <?php foreach ($articles as $article): ?>
                <tr>
                    <td><?=$article['name']; ?></td>
                    <td>
                        <?=$article['quantity']; ?>
                        &nbsp;
                        <?=$article['unity']; ?>
                    </td>
                    <td><?=$article['description']; ?></td>

                    <!-- Prix par enseigne -->
                    <?php
                        $i = 0;
                        foreach ($signs as $sign):
                    ?>
                        <td>
                            <?php
                                echo $article['prices'][$i];
                                $i++;
                            ?>
                        </td>
                    <?php endforeach; ?>

                    <!--
                    <td>
                        <a href="index.php?action=articlesUpdate&id=<?=$article['id']; ?>">
                            <button>Modifier</button>
                        </a>
                    </td>
                    -->
                    <td>
                        <a href="index.php?action=articlesDelete&id=<?=$article['id']; ?>">
                            <button>Supprimer</button>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <a href="index.php?action=articlesAdd">
            <button>Ajouter un article</button>
        </a>
    </main>


<?php
// Store the buffered content in a variable
$content = ob_get_clean();

// Require the layout file 'gabarit.php'
require 'gabarit.php';
?>