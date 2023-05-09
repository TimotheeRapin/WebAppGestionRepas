<?php
/**
 * Project                  TPI - Application web pour la gestion des repas en lien avec les commissions et le budget
 * @file                    navigation.php
 * @brief                   This file is designed to manage the navigation of the site
 * @author                  Created by Timothée RAPIN
 * Creation date            05.05.2021
 * update                   05.05.2021
 * @version                 0.1
 * @note                    Creation of this file
 */

/**
 * @brief This function is designed to display the home page
 */
function home()
{
    require_once "View/home.php";
}

/**
 * @brief This function is designed to display the menus page
 */
function menusList()
{
    require_once "View/menusList.php";
}

/**
 * @brief This function is designed to display the recipes page
 */
function foodList()
{
    require_once "View/foodList.php";
}

/**
 * @brief This function is designed to display the shopping list page
 */
function shoppingList()
{
    require_once "View/shoppingList.php";
}

/**
 * @brief This function is designed to display the signs list page
 */
function signsList()
{
    require_once "View/signsList.php";
}

/**
 * @brief This function is designed to display the articles list page
 */
function articlesList()
{
    require_once "View/articlesList.php";
}

/**
 * @brief This function is designed to inform the user that the resource requested doesn't exist (if the user modify the url manually)
 */
function lost()
{
    require_once "View/lost.php";
}