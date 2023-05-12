<?php
/**
 * Projet                   TPI - Application web pour la gestion des repas en lien avec les commissions et le budget
 * @file                    index.php
 * @brief                   This file is designed to manage the navigation of the site
 * @author                  Created by Timothée RAPIN
 * Creation date            05.05.2023
 * update                   11.05.2023
 * @version                 1.0
 * @note                    Add users management
 */


// Start a new session
session_start();

// Include the controller files
require_once "Controller/navigation.php";
require_once "Controller/users.php";
require_once "Controller/signs.php";
require_once "Controller/articles.php";

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
            userAdd($_POST);
            break;
        case 'usersList' :
            usersList();
            break;
        case 'usersDelete' :
            userDelete($_GET);
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
            articleAdd($_POST);
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

        case 'signsAdd' :
            signAdd($_POST);
            break;
        case 'signsList' :
            signsList();
            break;
        case 'signsDelete' :
            signsDelete($_GET);
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