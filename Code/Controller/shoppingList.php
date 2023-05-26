<?php
/**
 * Project                  TPI - Application web pour la gestion des repas en lien avec les commissions et le budget
 * @file                    shoppingList.php
 * @brief                   This file is designed to manage the shopping list
 * @authors                 Created by Timothée RAPIN
 * creation date            25.05.2023
 * update                   25.05.2023
 * version                  1.1
 * @note                    ajout de la fonction shoppingListDeleteArticle
 */

// Include the model file
require_once "Model/shoppingListManager.php";

/**
 * @brief This function is designed to display the shopping list
 * @param $data
 * @return void
 */
function shoppingList($data){

    $displayType = $data['displayType'];
    if (isset($data['displayType']) && $data['displayType'] == "oneSign") {
        $displayType = "oneSign";
    }
    else {
        $displayType = "allSigns";
    }

    // Get all the articles from the database
    $articles = getArticlesListDisplay($displayType);


    // Call the view 'shoppingList' to display the shopping list
    require_once "View/shoppingList.php";
}

function shoppingListAdd() {

    // Call the function to create the shopping list
    createShoppingList();

    require_once "View/shoppingList.php";
}

/**
 * @brief This function is designed to delete an article from the shopping list of the user
 * @param $data
 * @return void
 */
function shoppingListDeleteArticle($data) {

    // Call the function to delete the article
    deleteArticleInShoppingList($data);

    // Call the function to display the shopping list
    shoppingList($data);
}