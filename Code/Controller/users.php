<?php
/**
 * Project                  TPI - Application web pour la gestion des repas en lien avec les commissions et le budget
 * @file                    users.php
 * @brief                   This file is designed to manage the users
 * @author                  Created by Timothée RAPIN
 * Creation date            05.05.2021
 * update                   05.05.2021
 * @version                 0.1
 */

/**
 * @brief This function is designed to create a new user session
 * @param $userEmailAddress : user unique id, must be meet RFC 5321/5322
 */
function createSession($userEmailAddress, $userType)
{
    require_once "Model/usersManager.php";

    $_SESSION['userEmailAddress'] = $userEmailAddress;
    $_SESSION['userType'] = $userType;
    $_SESSION['id'] = getUserId ($userEmailAddress)[0];
}