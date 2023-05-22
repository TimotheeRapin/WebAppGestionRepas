<?php
/**
 * Project                  TPI - Application web pour la gestion des repas en lien avec les commissions et le budget
 * @file                    menusManager.php
 * @brief                   This file is designed to manage the menus in the database
 * @authors                 Created by Timothée RAPIN
 * creation date            16.05.2023
 * update                   16.05.2023
 * version                  0.1
 * @note                    creation of the file
 */

// Include the database connection file
require_once "dbConnector.php";
require_once "foodsManager.php";

function getMenusList () {

    $query = "SELECT menus.id, menus.title, menus.menuNumber, menus_has_foods.nbPersons, foods.id AS foodId, foods.name, foods.difficulty, foods.instruction, foods.type
                FROM menus
                LEFT JOIN menus_has_foods ON menus_has_foods.menus_id = menus.id
                LEFT JOIN foods ON foods.id = menus_has_foods.foods_id
                ORDER BY menus.title ASC, foods.type ASC, foods.name ASC;";


    $queryResult = executeQuerySelect($query);

    $menus = array();
    foreach ($queryResult as $row) {
        $menuId = $row['id'];
        // Permet de rassembler les menus qui ont le même id dans une même ligne
        if (!isset($menus[$menuId])) {
            $menus[$menuId] = array(
                'id' => $row['id'],
                'title' => $row['title'],
                'menuNumber' => $row['menuNumber'],
                'foods' => array()  // Tableau vide pour stocker les recettes
            );
        }
        // Ajouter les informations de la recette pour chaque menu
        $menuFood = array(
            'foodId' => $row['foodId'],
            'name' => $row['name'],
            'nbPersons' => $row['nbPersons'],
            'difficulty' => $row['difficulty'],
            'instruction' => $row['instruction'],
            'type' => $row['type']
        );
        $menus[$menuId]['foods'][] = $menuFood;
    }

    $result = $menus;
    return $result;
}

function menuManage($data){
    $foods = getFoodsList();
    $menus = getMenusList();
    try {

        //variable set
        if (isset($data['inputMenuTitle']) && isset($data['inputMenuFood']) && isset($data['inputMenuNbPersons'])) {
            $data['inputMenuNumber'] = $_SESSION['id'] . "_" . $data['inputMenuTitle'];
            $strSeparator = "'";
            //Test si le menu existe déjà (menuNumber = id du user et titre du menu)
            $query = "SELECT menus.menuNumber FROM menus WHERE menus.menuNumber = " . $strSeparator . $data['inputMenuNumber'] . $strSeparator . ";";
            $menu = executeQuerySelect($query);

            // Test si le menu existe déjà
            $existMenu = false;
            if (isset($menu) && $menu != "" && $menu != null && $menu != 0) {
                $dataMenu = $menu;
                $id = $menu['id'];
                $existMenu = true;
            }

            // Si le menu n'existe pas dans la BDD
            if ($existMenu == false) {

                // Si le titre du menu n'est pas vide
                if ($data['inputMenuTitle'] != "") {

                    // Si le nombre de personnes n'est pas négatif
                    if ($data['inputMenuNbPersons'] >= 0 || $data['inputMenuNbPersons'] === null) {

                                // Si l'article à bien été créé dans la BDD
                                if (createMenu($data)) {
                                    $menuErrorMessage = null;
                                    require "View/menusList.php";
                                }
                                else {
                                    $menuErrorMessage = "Le menu n'a pas pu être créé !";
                                    require "View/menuForm.php";
                                }
                    }
                    else {
                        $menuErrorMessage = "Le nombre de personnes ne peut pas être négatif !";
                        require "View/menuForm.php";
                    }

                }
                else {
                    $menuErrorMessage = "Le titre doit être remplis !";
                    require "View/menuForm.php";
                }
            }
            else {
                $menuErrorMessage = "Le menu existe déjà !";
                require "View/menuForm.php";
            }
        }
        else {
            $menuErrorMessage = null;
            require "View/menuForm.php";
        }

    }
    catch (ModelDataBaseException $ex) {
        $menuErrorMessage = "Nous rencontrons actuellement un problème technique. Il est temporairement impossible de gérer les articles. Désolé du dérangement !";
        require "View/menuForm.php";
    }
}

function createMenu($data) {
    $strSeparator = "'";
    $query = "INSERT INTO menus (title, menuNumber, accounts_id) VALUES (" . $strSeparator . $data['inputMenuTitle'] . $strSeparator . ", " . $strSeparator . $data['inputMenuNumber'] . $strSeparator . ", " . $_SESSION['id'] . ");";
    $queryResult = executeQueryInsert($query);
    $query = "SELECT menus.id FROM menus WHERE menus.menuNumber = " . $strSeparator . $data['inputMenuNumber'] . $strSeparator . ";";
    $menuId = executeQuerySelect($query)[0]['id'];
    $foods = $data['inputMenuFood'];
    $query = "INSERT INTO menus_has_foods (menus_id, foods_id, nbPersons) VALUES (" . $menuId . ", " . $foods . ", " . $data['inputMenuNbPersons'] . ");";
    $queryResult = executeQueryInsert($query);
    return $queryResult;
}