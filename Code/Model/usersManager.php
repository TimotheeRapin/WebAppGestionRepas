<?php
/**
 * Project                  TPI - Application web pour la gestion des repas en lien avec les commissions et le budget
 * @file                    usersManager.php
 * @brief                   This file is designed to manage the users
 * @author                  Created by Timothée RAPIN
 * Date de création         09.05.2023
 * update                   09.05.2023
 * @version                 0.1
 */

require_once "Model/dbConnector.php";

/**
 * @brief This function is designed to verify user's login
 * @param $userEmailAddress : must be meet RFC 5321/5322
 * @param $userPsw : users's password
 * @return bool : "true" only if the user and psw match the database. In all other cases will be "false".
 * @throws ModelDataBaseException : will be throw if something goes wrong with the database opening process
 */
function isLoginCorrect($userEmailAddress, $userPsw)
{
    $result = false;

    $strSeparator = "'";
    $query = "SELECT accounts.password FROM accounts WHERE accounts.email = " . $strSeparator . $userEmailAddress . $strSeparator;

    //$query = "SELECT parents.password FROM parents WHERE parents.email = " . $strSeparator . $userEmailAddress . $strSeparator;


    require_once 'Model/dbConnector.php';
    $queryResult = executeQuerySelect($query);
    $queryResult = $queryResult[0];
    $queryResultPsw = $queryResult['password'];
    $userHashPsw = password_hash($userPsw, PASSWORD_DEFAULT);
    if ($queryResultPsw){
        if (password_verify($userPsw, $queryResultPsw)){
            return true;
        }
    }

    return $result;
}

/**
 * @brief This function is designed to get the user's name
 * @param $userEmailAddress
 * @return string
 */
function firstNameLastName($userEmailAddress, $userType){


    $strSeparator = "'";
    $query = "SELECT accounts.firstName, accounts.lastName FROM accounts WHERE accounts.email = " . $strSeparator . $userEmailAddress . $strSeparator;

    require_once 'Model/dbConnector.php';
    $queryResult = executeQuerySelect($query);
    $user = $queryResult[0];

    $firstName = $user['firstName'];
    $lastName = $user['lastName'];

    $result = "$firstName $lastName";
    return $result;
}

/**
 * @brief This function is designed to register a new account
 * @param $userEmailAddress : must be meet RFC 5321/5322
 * @param $userPsw : user's password
 * @return bool : "true" only if the user doesn't already exist. In all other cases will be "false".
 * @throws ModelDataBaseException : will be throw if something goes wrong with the database opening process
 */
function registerAccount(/*$id, */$userFirstName, $userLastName, $userEmailAddress, $userPsw)
{
    $result = false;

    $strSeparator = "'";

    $userHashPsw = password_hash($userPsw, PASSWORD_DEFAULT);

    $registerQuery = "INSERT INTO accounts (firstName, lastName, email, password, type) VALUES ('$userFirstName', '$userLastName', '$userEmailAddress', '$userHashPsw', 'User')";

    require_once 'Model/dbConnector.php';
    $queryResult = executeQueryInsert($registerQuery);
    if ($queryResult){
        $result = $queryResult;
    }

    return $result;
}

/**
 * @brief This function is designed to update a user
 * @param $data
 */
function userManage($data){
    try {
        //variable set
        if (isset($data['inputUserEmailAddress']) && isset($data['inputUserPsw']) && isset($data['inputUserPswRepeat'])) {

            $strSeparator = "'";
            $query = "SELECT accounts.firstName, accounts.lastName, accounts.email, accounts.password FROM accounts WHERE accounts.email = " . $strSeparator . $data['inputUserEmailAddress'] . $strSeparator;
            $user = executeQuerySelect($query);

            // Test si l'email existe déjà
            $existAccount = false;
            if (isset($user) && $user!="" && $user!=null && $user!=0){
                $dataUser = $user;
                $id = $user['id'];
                $existAccount = true;
            }

            // Si l'email n'existe pas dans la BDD
            if ($existAccount == false){

                // Si l'utilisateur à entré 2 fois le même mot de passe
                if ($data['inputUserPsw'] == $data['inputUserPswRepeat']) {
                    require_once "Model/usersManager.php";

                    // Si le compte à bien été créé dans la BDD
                    if (registerAccount($data['inputUserFirstName'], $data['inputUserLastName'], $data['inputUserEmailAddress'], $data['inputUserPsw']))
                    {
                        // Crée la séssion si elle n'éxiste pas
                        if (!isset($_SESSION['userEmailAddress'])){
                            createSession($data['inputUserEmailAddress'],0);
                        }
                        $registerErrorMessage = null;
                        require "View/home.php";
                    }
                    else
                    {
                        $registerErrorMessage = "L'inscription n'est pas possible avec les valeurs saisies !";
                        require "View/register.php";
                    }

                }
                else
                {
                    $registerErrorMessage = "Les mots de passe ne sont pas similaires !";
                    require "View/register.php";
                }
            }
            else{
                $registerErrorMessage = "L'adresse email existe déjà !";
                require "View/register.php";
            }
        }
        else
        {
            $registerErrorMessage = null;
            require "View/register.php";
        }

    } catch (ModelDataBaseException $ex) {
        $registerErrorMessage = "Nous rencontrons actuellement un problème technique. Il est temporairement impossible de s'enregistrer. Désolé du dérangement !";
        require "View/register.php";
    }
}

/**
 * @brief This function is designed to manage the user's account
 * @param $data
 * @return void
 */
function userAccountManageInDb($data){
    // Récupérer les valeurs du formulaire
    $userId = $data['id'];

    $strSeparator = "'";
    $query = "SELECT accounts.firstName, accounts.lastName, accounts.email, accounts.password, accounts.type FROM accounts WHERE accounts.id = " . $strSeparator . $userId . $strSeparator;


    require_once 'Model/dbConnector.php';
    $queryResult = executeQuerySelect($query);
    $user = $queryResult[0];

    $userFirstName = $user['firstName'];
    $userLastName = $user['lastName'];
    $userEmailAddress = $user['email'];
    $userType = $user['type'];

    /*
        $userIdSession = $queryResult[0];
        $userIdSession = $userIdSession[0];
    */
    try {
        //variable set
        if (isset($userId) && isset($userEmailAddress)){

            // Test si l'email existe déjà
            $strSeparator = "'";
            $query = "SELECT accounts.email FROM accounts WHERE accounts.id = " . $strSeparator . $userId . $strSeparator;

            $queryResult = executeQuerySelect($query);
            $userEmail = $queryResult[0];
            $existAccount = false;
            if (isset($userEmail) && $userEmail!="" && $userEmail!=null && $userEmail!=0 && $userEmail['email']!=$user['email']){
                $existAccount = true;
            }

            // Si l'email n'existe pas dans la BDD
            if ($existAccount == false){

                // Si l'utilisateur à entré 2 fois le même mot de passe
                /*if ($data['inputUserPsw'] == $data['inputUserPswRepeat']) {
                    require_once "Model/usersManager.php";*/

                // Si le compte à bien été créé dans la BDD

                switch ($userType){
                    case 'User': // Compte utilisateur
                        // Si le compte à bien été créé dans la BDD
                        if (updateAccount($userId, $data['inputUserFirstName'], $data['inputUserLastName'], $data['inputUserEmailAddress'])) {
                            $registerErrorMessage = NULL;
                            //administration();
                        }
                        else {
                            $registerErrorMessage = "La modification n'est pas possible avec les valeurs saisies !";
                            require "View/updateUser.php";
                        }
                        break;
                    case 'Administrator': // Administrators
                        // S'il y a toujours 1 administrateur
                        $query = "SELECT count(accounts.email) FROM accounts WHERE accounts.type = 'Administrators'";
                        $nbAdmin = executeQuerySelect($query);
                        $nbAdmin = $nbAdmin[0][0];

                        if ($nbAdmin>1 || $user['id']!=$userIdSession && $userType=='Administrators'){

                            // Si le compte à bien été créé dans la BDD
                            if (updateAccount($userId, $data['inputUserFirstName'], $data['inputUserLastName'], $data['inputUserEmailAddress'])) {
                                $registerErrorMessage = NULL;
                                //administration();
                            }
                            else {
                                $registerErrorMessage = "La modification n'est pas possible avec les valeurs saisies !";
                                require "View/updateUser.php";
                            }
                        }
                        else
                        {
                            $registerErrorMessage = "Il faut minimum 1 Administrateur !";
                            require "View/updateUser.php";
                        }
                        break;
                }

                /*
                                }
                                else
                                {
                                    $registerErrorMessage = "Les mots de passe ne sont pas similaires !";
                                    require "view/updateUser.php";
                                }
                */
            }
            else{
                $registerErrorMessage = "L'adresse email existe déjà !";
                require "View/updateUser.php";
            }
        }
        else
        {
            $registerErrorMessage = null;
            require "View/updateUser.php";
        }
    }
    catch (ModelDataBaseException $ex) {
        $registerErrorMessage = "Nous rencontrons actuellement un problème technique. Il est temporairement impossible de modifier son compte. Désolé pour le dérangement !";
        require "View/updateUser.php";
    }
}

/**
 * @brief This function get the id of the user
 * @param $userEmailAddress
 * @return mixed
 */
function getUserId($userEmailAddress)
{
    $strSeparator = "'";
    $query = "SELECT id FROM accounts WHERE accounts.email = " . $strSeparator . $userEmailAddress . $strSeparator;

    require_once 'Model/dbConnector.php';
    $queryResult = executeQuerySelect($query);
    $queryResult = $queryResult[0];
    return $queryResult;
}

/**
 * @brief This function get the type of the user
 * @param $userEmailAddress
 * @return mixed
 */
function getUserType($userEmailAddress)
{
    $strSeparator = "'";
    $query = "SELECT accounts.type FROM accounts WHERE accounts.email = " . $strSeparator . $userEmailAddress . $strSeparator;

    require_once 'Model/dbConnector.php';
    $queryResult = executeQuerySelect($query);
    $queryResult = $queryResult[0];
    return $queryResult;
}

/**
 * @brief This function get the type of the user
 * @return array
 */
function getUserList(){
    require_once 'Model/dbConnector.php';

    $query = "SELECT accounts.id, accounts.firstName, accounts.lastName, accounts.email FROM accounts WHERE accounts.type = 'User' ORDER BY accounts.lastName ASC";
    $queryResult = executeQuerySelect($query);
    $userList[0] = $queryResult;

    $query = "SELECT accounts.id, accounts.firstName, accounts.lastName, accounts.email FROM accounts WHERE accounts.type = 'Administrator' ORDER BY accounts.lastName ASC";
    $queryResult = executeQuerySelect($query);
    $userList[1] = $queryResult;

    return $userList;
}