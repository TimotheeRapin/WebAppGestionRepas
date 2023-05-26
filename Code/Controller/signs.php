<?php
/**
 * Project                  TPI - Application web pour la gestion des repas en lien avec les commissions et le budget
 * @file                    signs.php
 * @brief                   This file is designed to manage the signs
 * @authors                 Created by Timothée RAPIN
 * creation date            11.05.2023
 * update                   11.05.2023
 * version                  1.0
 * @note                    creation of the file
 */

// Include the model file
require_once "Model/signsManager.php";

/**
 * @brief This function is designed to display the signs list
 * @return void
 */
function signsList()
{
    // Get all the signs from the database
    $signs = getSignsList();

    // Call the view 'signsList' to display the signs list
    require_once "View/signsList.php";
}

/**
 * @brief This function is designed to display the signs add form
 * @param $data
 * @return void
 */
function signAdd($data)
{
    signsManage($data);
    require_once 'Model/signsManager.php';
}

/**
 * @brief This function is designed to delete a sign from the database
 * @param $data
 * @return void
 */
function signsDelete($data){

    deleteSign($data['id']);
    signsList();
}