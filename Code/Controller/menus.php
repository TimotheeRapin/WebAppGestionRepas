<?php
/**
 * Project                  TPI - Application web pour la gestion des repas en lien avec les commissions et le budget
 * @file                    menus.php
 * @brief                   This file is designed to manage the menus
 * @authors                 Created by Timothée RAPIN
 * creation date            16.05.2023
 * update                   16.05.2023
 * version                  1.0
 * @note                    creation of the file
 */

// Include the model file
require_once "Model/menusManager.php";
require_once "Model/foodsManager.php";

/**
 * @brief This function is designed to display the menus list
 * @return void
 */
function menusList()
{
    // Get all the foods from the database
    $menus = getMenusList();

    // Call the view 'foodsList' to display the foods list
    require_once "View/menusList.php";
}

/**
 * @brief This function is designed to display the menus add form
 * @param $data
 * @return void
 */
function menuAdd($data)
{
    menuManage($data);
}