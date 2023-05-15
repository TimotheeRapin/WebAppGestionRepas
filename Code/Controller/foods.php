<?php
/**
 * Project                  TPI - Application web pour la gestion des repas en lien avec les commissions et le budget
 * @file                    foods.php
 * @brief                   This file is designed to manage the foods
 * @authors                 Created by Timothée RAPIN
 * creation date            15.05.2023
 * update                   15.05.2023
 * version                  0.1
 * @note                    creation of the file
 */

// Include the model file
require_once "Model/foodsManager.php";

/**
 * @brief This function is designed to display the foods list
 */
function foodsList()
{
    // Get all the foods from the database
    $foods = getFoodsList();

    $Starters = $foods[0];
    $Dishs = $foods[1];
    $Desserts = $foods[2];

/*
    $users = $userList[0];
    $administrators = $userList[1];
*/

    // Call the view 'foodsList' to display the foods list
    require_once "View/foodsList.php";
}

/**
 * @brief This function is designed to display the foods add form
 */
function foodAdd($data)
{
    foodsManage($data);
    require_once 'Model/foodsManager.php';
}