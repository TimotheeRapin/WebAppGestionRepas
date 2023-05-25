<?php
/**
 * Project                  TPI - Application web pour la gestion des repas en lien avec les commissions et le budget
 * @file                    shoppingList.php
 * @brief                   This file is designed to manage the shopping list
 * @authors                 Created by Timothée RAPIN
 * creation date            25.05.2023
 * update                   25.05.2023
 * version                  1.0
 * @note                    creation of the file
 */

// Include the model file
require_once "Model/shoppingListManager.php";

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