<?php
/**
 * Project                  TPI - Application web pour la gestion des repas en lien avec les commissions et le budget
 * @file                    foodDetails.php
 * @brief                   This file is designed to display details of a food
 * @authors                 Created by Timothée RAPIN
 * creation date            16.05.2023
 * update                   16.05.2023
 * version                  0.1
 * @note                    creation of the file
 */

// Start output buffering
ob_start();

// Define the title of the page
$title = 'Application web pour la gestion des repas en lien avec les commissions et le budget - Détails d\'une recette';

?>

<!-- Page content -->
<main id="page" class="container">
    <h1>Détails d'une recette</h1>
    <h2><?=$food['name']; ?></h2>
    <p class="center"><?=$food['instruction']; ?></p>

    <h3>Quantité</h3>
    <p class="center"><?=$food['nbPersons']; ?></p>

    <h3>Difficulté</h3>
    <p class="center"><?=$food['difficulty'] . " sur 3"; ?></p>

    <br>

    <h3>Ingrédients</h3>
    <p class="center">
        <?php foreach ($food['articles'] as $article): ?>
                <a href="index.php?action=articleDetails&id=<?=$article; ?>">
                    <?=$article['quantity'] . " " . $article['unity'] . " de " . $article['articles']; ?>
                </a><br>
        <?php endforeach; ?>
    </p>

        <br>
    <a href="index.php?action=foodsList">
        <button>Retour à la liste des recettes</button>
    </a>

    <br>
    <?php if (isset($_SESSION['userType']) && $_SESSION['userType'] == 'User') : ?>
        <a href="index.php?action=addFoodToMenu&id=<?=$food['id']; ?>">
            <button>Ajouter à un menu</button>
        </a>
    <?php endif; ?>
</main>

<?php
// Store the buffered content in a variable
$content = ob_get_clean();

// Require the layout file 'gabarit.php'
require 'gabarit.php';
?>