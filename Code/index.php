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
require_once "Controller/foods.php";
require_once "Controller/menus.php";
require_once "Controller/shoppingList.php";

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
            menuAdd($_POST);
            break;
        case 'menusList' :
            menusList();
            break;
        case 'menusDelete' :
            menuDelete($_POST);
            break;

        case 'foodsAdd' :
            foodAdd($_POST);
            break;
        case 'foodsList' :
            foodsList();
            break;
        case 'foodsDelete' :
            foodDelete($_POST);
            break;

        case 'foodDetails' :
            foodDetails($_GET);
            break;


        case 'articlesAdd' :
            articleAdd($_POST);
            break;
        case 'articlesList' :
            articlesList();
            break;
        case 'articlesDelete' :
            articleDelete($_GET);
            break;

        case 'shoppingListAdd' :
            shoppingListAdd();
            break;
        case 'shoppingList' :
            shoppingList($_GET);
            break;
        case 'shoppingListDeleteArticle' :
            shoppingListDeleteArticle($_GET);
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