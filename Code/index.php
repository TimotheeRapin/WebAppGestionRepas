<?php
/**
 * Projet                   TPI - Application web pour la gestion des repas en lien avec les commissions et le budget
 * @file                    index.php
 * @brief                   This file is designed to manage the navigation of the site
 * @author                  Created by Timothée RAPIN
 * Creation date            05.05.2023
 * update                   05.05.2023
 * @version                 0.1
 * @note                    Creation of this file
 */


// Start a new session
session_start();

// Include the file "Controller/navigation.php"
require_once "Controller/navigation.php";
require_once "Controller/users.php";

// Check if the GET parameter 'action' is set
if (isset($_GET['action'])) {

    // Store the value of 'action' in a variable
    $action = $_GET['action'];

    // Use a switch statement to determine which function to call based on the value of 'action'
    switch ($action) {
        case 'home' :
            home();
            break;
        case 'login' :
            login($_POST);
            break;
        case 'userManage' :
            userAccountManage($_POST);
            break;
        case 'logout' :
            logout();
            break;
        case 'register' :
            register($_POST);
            break;

        case 'usersAdd' :
            usersAdd($_POST);
            break;
        case 'usersList' :
            usersList();
            break;
        case 'usersDelete' :
            usersDelete($_POST);
            break;

        case 'menusAdd' :
            menusAdd($_POST);
            break;
        case 'menusList' :
            menusList();
            break;
        case 'menusDelete' :
            menusDelete($_POST);
            break;

        case 'foodsAdd' :
            foodsAdd($_POST);
            break;
        case 'foodsList' :
            foodsList();
            break;
        case 'foodsDelete' :
            foodsDelete($_POST);
            break;

        case 'ingredientsAdd' :
            ingredientsAdd($_POST);
            break;
        case 'ingredientsList' :
            ingredientsList();
            break;
        case 'ingredientsDelete' :
            ingredientsDelete($_POST);
            break;

        case 'articlesAdd' :
            articlesAdd($_POST);
            break;
        case 'articlesList' :
            articlesList();
            break;
        case 'articlesDelete' :
            articlesDelete($_POST);
            break;

        case 'shoppingListAdd' :
            shoppingListAdd($_POST);
            break;
        case 'shoppingListList' :
            shoppingListList();
            break;
        case 'shoppingListDelete' :
            shoppingListDelete($_POST);
            break;

        // If the value of 'action' is not recognized, call the 'lost' function
        default :
            lost();
    }
}

// Call the 'home' function if 'action' is not set
else {
    home();
}