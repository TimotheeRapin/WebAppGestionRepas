<?php
/**
 * Project                  TPI - Application web pour la gestion des repas en lien avec les commissions et le budget
 * @file                    shoppingList.php
 * @brief                   This file is designed to display the articles list
 * @author                  Created by Timothée RAPIN
 * Creation date            25.05.2023
 * update                   25.05.2023
 * @version                 1.0
 * @note                    Creation of this file
 */



// Start output buffering
ob_start();

// Define the title of the page
$title = 'Application web pour la gestion des repas en lien avec les commissions et le budget - Liste de commissions';

?>

    <!-- Page content -->
    <main id="page" class="container">
        <h1>Liste de commissions</h1>

        <?php if (isset($displayType)): ?>
            <h2>Liste pour les articles les moins cher peu importe l'enseigne</h2>
        <?php else: ?>
            <h2>Liste pour l'enseigne la moins cher</h2>
        <?php endif; ?>

        <a href="index.php?action=shoppingListAdd">
            <button>Générer la liste à partir des menus</button>
        </a><br><br><br>
        <a href="index.php?action=shoppingList&displayType=oneSign">
            <button>Enseigne la moins cher</button>
        </a><br>
        <a href="index.php?action=shoppingList&displayType=allSigns">
            <button>Toutes les enseignes</button>
        </a><br>

        <table class="userList">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Quantité</th>
                    <th>Prix</th>
                    <th>Enseigne</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($displayType)): ?>
                    <?php foreach ($articles as $article): ?>
                        <tr>
                            <td><?=$article['name']; ?></td>
                            <td><?=$article['description']; ?></td>
                            <td>
                                <?=$article['quantity']; ?>
                                &nbsp;
                                <?=$article['unity']; ?>
                            </td>
                            <td><?=$article['price']; ?></td>
                            <td><?=$article['signs']; ?></td>
                            <td>
                                <a href="index.php?action=shoppingListDeleteArticle&id=<?=$article['id']; ?>">
                                    <button>Supprimer</button>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </main>


<?php
// Store the buffered content in a variable
$content = ob_get_clean();

// Require the layout file 'gabarit.php'
require 'gabarit.php';
?>