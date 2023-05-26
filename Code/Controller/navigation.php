<?php
/**
 * Project                  TPI - Application web pour la gestion des repas en lien avec les commissions et le budget
 * @file                    navigation.php
 * @brief                   This file is designed to manage the navigation of the site
 * @author                  Created by Timothée RAPIN
 * Creation date            05.05.2021
 * update                   05.05.2021
 * @version                 1.0
 * @note                    Creation of this file
 */

/**
 * @brief This function is designed to display the home page
 * @return void
 */
function home()
{
    require_once "View/home.php";
}

/**
 * @brief This function is designed to inform the user that the resource requested doesn't exist (if the user modify the url manually)
 * @return void
 */
function lost()
{
    require_once "View/lost.php";
}