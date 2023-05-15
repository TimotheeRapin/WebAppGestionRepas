<?php
/**
 * Project                  TPI - Application web pour la gestion des repas en lien avec les commissions et le budget
 * @file                    articleForm.php
 * @brief                   This file is designed to creat or modify an article
 * @author                  Created by Timothée RAPIN
 * Creation date            12.05.2023
 * update                   12.05.2023
 * @version                 0.1
 * @note                    Creation of this file
 */

// Start output buffering
ob_start();

// Define the title of the page
$title = "Application web pour la gestion des repas en lien avec les commissions et le budget - Création d'un article";
?>

<!-- Page content -->
<main id="page" class="container">
    <h1>Article</h1>

    <?php if (isset($articleErrorMessage)): ?>
        <div class="error">
            <?= $articleErrorMessage ?><br><br>
        </div>
    <?php endif; ?>

    <form class="login" action="index.php?action=articlesAdd" method="POST">

        <div data-validate = "un nom d'article est obligatoire">
            <input type="text" name="inputArticleName" placeholder="Nom de l'article" value="<?php if( isset($_POST['inputArticleName'])) {echo $_POST['inputArticleName'];}?>"/>
        </div>

        <div>
            <input type="text" name="inputArticleDescription" placeholder="Description de l'article" value="<?php if( isset($_POST['inputArticleDescription'])) {echo $_POST['inputArticleDescription'];}?>"/>
        </div>

        <div data-validate = "une quantité est obligatoire">
            <input type="number" name="inputArticleQuantity" placeholder="Quantité de l'article" value="<?php if( isset($_POST['inputArticleQuantity'])) {echo $_POST['inputArticleQuantity'];}?>"/>
        </div>

        <div>
            <select id="articleUnity" name="inputArticleUnity">
                <option value="0">Unité</option>
                <option value="g">g</option>
                <option value="kg">kg</option>
                <option value="ml">ml</option>
                <option value="cl">cl</option>
                <option value="l">l</option>
                <option value="pce">pce</option>
            </select>
        </div>

        <span>Prix par enseigne</span>
        <?php foreach ($signs as $sign) : ?>
            <div>
                <input type="text" name="inputArticlePriceSign<?= $sign['id'] ?>" placeholder="Prix chez <?= $sign['name'] ?>" value="<?php if( isset($_POST['inputArticlePriceSign'.$sign['id']])) {echo $_POST['inputArticlePriceSign'.$sign['id']];}?>"/>
            </div>
        <?php endforeach; ?>


        <div>
            <button class="buttonCenter" type="submit">
                Ajouter/Modifier
            </button>
        </div>
    </form>
</main>

<?php
// Store the buffered content in a variable
$content = ob_get_clean();

// Require the layout file 'gabarit.php'
require 'gabarit.php';
?>