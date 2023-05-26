<?php
/**
 * Project                  TPI - Application web pour la gestion des repas en lien avec les commissions et le budget
 * @file                    users.php
 * @brief                   This file is designed to manage the users
 * @author                  Created by Timothée RAPIN
 * Creation date            05.05.2021
 * update                   11.05.2021
 * @version                 1.0
 * @note                    Add users management
 */

/**
 * @brief This function is designed to create a new user session
 * @param $userEmailAddress : user unique id, must be meet RFC 5321/5322
 * @return void
 */
function createSession($userEmailAddress)
{
    require_once "Model/usersManager.php";

    $_SESSION['userEmailAddress'] = $userEmailAddress;
    $_SESSION['userType'] = getUserType($userEmailAddress)[0];
    $_SESSION['id'] = getUserId ($userEmailAddress)[0];
}

/**
 * @brief This function is designed to get the user first name and last name
 * @param $userEmail : user email address
 * @param $userType : user type (parent, teacher, admin)
 * @return string
 */
function userName($userEmail, $userType){
    require_once "Model/usersManager.php";
    return firstNameLastName($userEmail, $userType);
}

/**
 * @brief This function is designed to manage login request
 * @param $loginRequest : containing login fields required to authenticate the user
 * @return void
 */
function login($loginRequest)
{
    //if login request was submitted
    try {
        if (isset($loginRequest['inputUserEmailAddress']) && isset($loginRequest['inputUserPsw'])) {
            //extract login parameters
            $userEmailAddress = $loginRequest['inputUserEmailAddress'];
            $userPsw = $loginRequest['inputUserPsw'];

            //try to check if user/psw are matching with the database
            require_once "Model/usersManager.php";
            if (isLoginCorrect($userEmailAddress, $userPsw)) {
                $loginErrorMessage = null;
                createSession($userEmailAddress);
                require "View/home.php";
            }
            else { //if the user/psw does not match, login form appears again with an error message
                $loginErrorMessage = "l'adresse email et/ou le mot de passe ne correspondent pas !";
                require "View/login.php";
            }
        } else { //the user does not yet fill the form
            require "View/login.php";
        }
    } catch (ModelDataBaseException $ex) {
        $loginErrorMessage = "Nous rencontrons actuellement un problème technique. Il est temporairement impossible de s'annoncer. Désolé du dérangement !";
        require "View/login.php";
    }
}

/**
 * @brief This function is designed to manage logout request
 * @remark In case of login, the user session will be destroyed.
 * @return void
 */
function logout()
{
    $_SESSION = array();
    session_destroy();
    require "View/home.php";
}

/**
 * @brief This function is designed manage the register request
 * @param $data : contains all fields mandatory and optional to register a new user (coming from a form)
 * @return void
 */
function register($data)
{
    require_once 'Model/usersManager.php';
    userManage($data);
}

/**
 * @brief This function is designed to display the user list page
 * @return void
 */
function usersList()
{
    require_once "Model/usersManager.php";
    $userList = getUserList();
    $users = $userList[0];
    $administrators = $userList[1];
    require_once "View/usersList.php";
}

/**
 * @brief This function is designed to delete a user
 * @param $data
 * @return void
 */
function userDelete($data){
    require_once "Model/usersManager.php";

    $UserEmail = getUserEmail($data['id']);
    $userType = getUserType($UserEmail[0]);
    $userType = $userType[0];

    if ($userType == 'Administrator') {
        deleteAdministrator($data['id']);
    }
    elseif ($userType == 'User') {
        deleteUser($data['id']);
    }
    else {
        throw new ModelDataBaseException("Le type d'utilisateur n'existe pas !");
    }

    usersList();
}

/**
 * @brief This function is designed to display the user add form
 * @param $data
 * @return void
 */
function userAdd($data){
    require_once "Model/usersManager.php";
    addUser($data);
}