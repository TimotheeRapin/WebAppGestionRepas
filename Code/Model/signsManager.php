<?php
/**
 * Project                  TPI - Application web pour la gestion des repas en lien avec les commissions et le budget
 * @file                    signsManager.php
 * @brief                   This file is designed to manage the signs
 * @authors                 Created by Timothée RAPIN
 * creation date            11.05.2023
 * update                   11.05.2023
 * version                  1.1
 * @note                    add delete signs in intermediaire table
 */

// Include the database connection file
require_once "dbConnector.php";

/**
 * @brief This function is designed to get all the signs from the database
 * @return $queryResult
 */
function getSignsList()
{

    $query = "SELECT signs.id, signs.name FROM signs ORDER BY signs.name ASC";
    $queryResult = executeQuerySelect($query);

    return $queryResult;
}

/**
 * @brief This function is designed to manage the signs in the database
 * @return $queryResult
 */
function signsManage($data){
    try {
        //variable set
        if (isset($data['inputSignName'])) {

            $strSeparator = "'";
            $query = "SELECT signs.name FROM signs WHERE signs.name = " . $strSeparator . $data['inputSignName'] . $strSeparator;
            $sign = executeQuerySelect($query);

            // Test si l'enseigne existe déjà
            $existSign = false;
            if (isset($sign) && $sign!="" && $sign!=null && $sign!=0){
                $dataSign = $sign;
                $id = $sign['id'];
                $existSign = true;
            }

            // Si l'enseigne n'existe pas dans la BDD
            if ($existSign == false){

                // Si tout les champs sont remplis
                if($data['inputSignName'] != ""){

                    // Si le compte à bien été créé dans la BDD
                    if (signsAdd($data['inputSignName'])) {
                        $signErrorMessage = null;
                        signsList();
                        //require "View/signsList.php";
                    } else {
                        $signErrorMessage = "La modification ou la création n'est pas possible avec les valeurs saisies !";
                        require "View/signForm.php";
                    }

                } else {
                    $signErrorMessage = "Veuillez remplir tout les champs !";
                    require "View/signForm.php";
                }

            } else {
                $signErrorMessage = "L'enseigne existe déjà !";
                require "View/signForm.php";
            }

        } else {
            $signErrorMessage = "Veuillez remplir tout les champs !";
            require "View/signForm.php";
        }
    } catch (Exception $signErrorMessage) {
        $signErrorMessage = "Nous rencontrons actuellement un problème technique. Il est temporairement impossible de modifier une enseigne. Désolé pour le dérangement !";
        require "View/signForm.php";
    }
}

/**
 * @brief This function is designed to add a sign in the database
 * @param $signName
 * @return bool
 */
function signsAdd($signName)
{
    $result = false;

    $strSeparator = "'";

    $signAddQuery = "INSERT INTO signs (name) VALUES ('$signName')";

    $queryResult = executeQueryInsert($signAddQuery);
    if ($queryResult){
        $result = $queryResult;
    }

    return $result;
}

/**
 * @brief This function is designed to delete a sign in the database
 * @param $signId
 */
function deleteSign($signId){
    $signId = intval($signId); // Conversion en int

    $strSeparator = "'";

    // Suppression de l'enseigne dans la table "signs_has_articles" + suppression de l'enseigne dans la table "signs"
    $query = "DELETE FROM signs_has_articles WHERE signs_has_articles.signs_id = " . $strSeparator . $signId . $strSeparator . ";
                DELETE FROM signs WHERE signs.id = " . $strSeparator . $signId . $strSeparator . ";";
    $queryResult = executeQueryDelete($query);
}