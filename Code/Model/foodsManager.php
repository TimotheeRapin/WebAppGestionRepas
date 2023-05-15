<?php
/**
 * Project                  TPI - Application web pour la gestion des repas en lien avec les commissions et le budget
 * @file                    foodsManager.php
 * @brief                   This file is designed to manage the foods
 * @authors                 Created by Timothée RAPIN
 * creation date            15.05.2023
 * update                   15.05.2023
 * version                  0.1
 * @note                    creation of the file
 */

// Include the database connection file
require_once "dbConnector.php";

/**
 * @brief This function is designed to display the foods list
 * @param $data contains the data to add
 */
function getFoodsList()
{
    $query = "SELECT foods.id, foods.name, foods.nbPersons, foods.time, foods.difficulty, foods.instruction, foods.type FROM foods
              WHERE foods.type = 'Starter'
              ORDER BY foods.name ASC";
    $queryResult = executeQuerySelect($query);
    $foods[0] = $queryResult;

    $query = "SELECT foods.id, foods.name, foods.nbPersons, foods.time, foods.difficulty, foods.instruction, foods.type FROM foods
              WHERE foods.type = 'Dish'
              ORDER BY foods.name ASC";
    $queryResult = executeQuerySelect($query);
    $foods[1] = $queryResult;

    $query = "SELECT foods.id, foods.name, foods.nbPersons, foods.time, foods.difficulty, foods.instruction, foods.type FROM foods
              WHERE foods.type = 'Dessert'
              ORDER BY foods.name ASC";
    $queryResult = executeQuerySelect($query);
    $foods[2] = $queryResult;

    return $foods;
}

/**
 * @brief This function is designed to add a food in the database
 * @param $data contains the data to add
 */
function foodsManage($data){
    try {
        //variable set
        if (isset($data['inputFoodName'])) {

            $strSeparator = "'";
            $query = "SELECT foods.name FROM foods WHERE foods.name = " . $strSeparator . $data['inputFoodName'] . $strSeparator;
            $food = executeQuerySelect($query);

            // Test si le plat existe déjà
            $existFood = false;
            if (isset($food) && $food!="" && $food!=null && $food!=0){
                $dataFood = $food;
                $id = $food['id'];
                $existFood = true;
            }

            // Si le plat n'existe pas dans la BDD
            if ($existFood == false){

                // Si tous le nom du plat est rempli
                if($data['inputFoodName'] != ""){

                    // Si le nombre de personnes est rempli
                    if ($data['inputFoodNbPersons'] != ""){

                        // Si le temps est n'est pas rempli
                        /*
                        if ($data['inputFoodTime'] == ""){
                            $data['inputFoodTime'] = "NULL";
                        }*/

                        // Si les instructions sont remplies
                        if ($data['inputFoodInstruction'] != ''){

                            // Si le type est sélectionné
                            if ($data['inputFoodType'] == 'Starter' || $data['inputFoodType'] == 'Dish' || $data['inputFoodType'] == 'Dessert'){

                                // Si le plat à bien été créé dans la BDD
                                if (foodsAdd($data)) {
                                    $foodErrorMessage = null;
                                    foodsList();
                                    //require "View/foodsList.php";
                                } else {
                                    $foodErrorMessage = "La modification ou la création n'est pas possible avec les valeurs saisies !";
                                    require "View/foodForm.php";
                                }
                            }
                            else {
                                $foodErrorMessage = "Le type de plat n'est pas sélectionné !";
                                require "View/foodForm.php";
                            }
                        }
                        else {
                            $foodErrorMessage = "Les instructions sont obligatoires !";
                            require "View/foodForm.php";
                        }
                    }
                    else {
                        $foodErrorMessage = "Le nombre de personnes est obligatoire !";
                        require "View/foodForm.php";
                    }
                }
                else {
                    $foodErrorMessage = "Un nom de plat est obligatoire !";
                    require "View/foodForm.php";
                }

            }
            else {
                $foodErrorMessage = "Le plat existe déjà !";
                require "View/foodForm.php";
            }

        }
        else {
            $foodErrorMessage = "Un nom de plat est obligatoire !";
            require "View/foodForm.php";
        }
    }
    catch (Exception $foodErrorMessage) {
        $foodErrorMessage = "Nous rencontrons actuellement un problème technique. Il est temporairement impossible de modifier un plat. Désolé pour le dérangement !";
        require "View/foodForm.php";
    }
}

function foodsAdd($data){
    $result = false;
    $strSeparator = "'";
    $foodName = $data['inputFoodName'];
    $foodNbPersons = $data['inputFoodNbPersons'];
    //$foodTime = $data['inputFoodTime'];
    $foodTime = "NULL";
    $foodDifficulty = $data['inputFoodDifficulty'];
    $foodInstruction = $data['inputFoodInstruction'];
    $foodType = $data['inputFoodType'];

    try {
        $query = "INSERT INTO foods (name, nbPersons, time, difficulty, instruction, type)
                    VALUES ('$foodName', $foodNbPersons, $foodTime, $foodDifficulty, '$foodInstruction', '$foodType')";
        $queryResult = executeQueryInsert($query);
        $result = $queryResult;

        return $result;
    }
    catch (Exception $foodErrorMessage) {
        throw new Exception("Erreur lors de l'ajout du plat dans la base de données");
    }
}