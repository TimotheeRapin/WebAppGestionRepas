<?php
/**
 * Project                  TPI - Application web pour la gestion des repas en lien avec les commissions et le budget
 * @file                    shoppingListManager.php
 * @brief                   This file is designed to manage the shopping list
 * @author                  Created by Timothée RAPIN
 * Creation date            25.05.2023
 * update                   25.05.2023
 * @version                 1.0
 * @note                    creation of the file
 */

// Include the database connection file
require_once "dbConnector.php";

/**
 * @brief This function is designed to display the shopping list
 * @param $displayType
 * @return array|null
 */
function getArticlesListDisplay($displayType){

    $strSeparator = "'";

    // récupère les article dans la liste de commission de la personne connectée
    /*
    $query = "SELECT articles.id FROM articles
                INNER JOIN `shopping lists` ON articles.id = `shopping lists`.articles_id
                WHERE `shopping lists`.name = " . $_SESSION['id'] . ";";
    $articles = executeQuerySelect($query);
*/

    // Récupère tous les recettes (id) de tous les menus de la personne connectée
    $query = "SELECT menus_has_foods.foods_id 
                FROM menus_has_foods 
                INNER JOIN menus ON menus_has_foods.menus_id = menus.id
                WHERE menus.accounts_id = " . $_SESSION['id'] . ";";

    $foods = executeQuerySelect($query);


    // Récupère tous les articles des recettes
    $articles = array();
    foreach ($foods as $food) {
        $query = "SELECT foods_has_articles.articles_id, foods_has_articles.quantity
                FROM foods_has_articles
                WHERE foods_has_articles.foods_id = " . $food['foods_id'] . ";";

        $queryResult = executeQuerySelect($query);

        foreach ($queryResult as $row) {
            $articleId = $row['articles_id'];
            // Permet de rassembler les articles qui ont le même id dans une même ligne
            if (!isset($articles[$articleId])) {
                $articles[$articleId] = array(
                    'id' => $row['articles_id'],
                    'quantity' => $row['quantity']
                );
            } else {
                $articles[$articleId]['quantity'] += $row['quantity'];
            }
        }
    }


    // Articles les moins chers dans une seule enseigne
    if ($displayType == "oneSign") {
        // Récupère tous les articles de la liste de commissions (la quantité d'un article est plus grand que la quantité dans la table foods_has_articles, si la quantité est plus petite, il y aura plusieur fois le même article dans la liste de commissions)
        $queryResult = array();

        // affiche tous les articles correspondant à tous les menus de la personne et uniquement les moins chers
        foreach ($articles as $article) {
            $query = "SELECT articles.id, articles.name, articles.quantity, articles.description, articles.unity, signs.name AS signs, signs_has_articles.price
                    FROM articles
                    /* Source : https://sql.sh/cours/sous-requete */
                    LEFT JOIN (
                        SELECT articles_id, MIN(price) AS minimumPrice  /* Source : https://www.w3schools.com/sql/sql_min_max.asp */
                        FROM signs_has_articles
                        GROUP BY articles_id
                    ) AS minimumPrices ON articles.id = minimumPrices.articles_id
                    LEFT JOIN signs_has_articles ON articles.id = signs_has_articles.articles_id AND minimumPrices.minimumPrice = signs_has_articles.price
                    LEFT JOIN signs ON signs.id = signs_has_articles.signs_id
                    WHERE articles.id = " . $article['id'] . ";";

            $articles = executeQuerySelect($query);
            $queryResult = array_merge($queryResult, $articles); // Source : https://www.php.net/manual/en/function.array-merge.php
        }

        foreach ($queryResult as $row) {
            $totalPrice[$row['signs']] += $row['price'];
        }

        // Récupère le nom de l'enseigne qui a le prix total le plus petit
        $minPrice = null;
        $signName = null;
        foreach ($totalPrice as $sign => $price) {
            if ($price > 0 && ($minPrice === null || $price < $minPrice)) {
                $minPrice = $price;
                $signName = $sign;
            }
        }





        foreach ($foods as $food){
            $query = "SELECT articles.id, articles.name, articles.quantity, articles.description, articles.unity, signs.name AS signs, signs_has_articles.price
                    FROM articles
                    CROSS JOIN signs
                    LEFT JOIN signs_has_articles ON articles.id = signs_has_articles.articles_id 
                    AND signs.id = signs_has_articles.signs_id
                    WHERE articles.id = " . $food['foods_id'] . ";";

            $articles = executeQuerySelect($query);
            $queryResult = array_merge($queryResult, $articles); // Source : https://www.php.net/manual/en/function.array-merge.php


            $articles = array();
            foreach ($queryResult as $row) {
                $articleId = $row['id'];
                // Permet de rassembler les articles qui ont le même id dans une même ligne
                if (!isset($articles[$articleId])) {
                    $articles[$articleId] = array(
                        'id' => $row['id'],
                        'name' => $row['name'],
                        'quantity' => $row['quantity'],
                        'description' => $row['description'],
                        'unity' => $row['unity'],
                        'prices' => array()  // Tableau vide pour stocker les prix
                    );
                }
                // Ajoutez le prix pour chaques enseignes à la liste des prix de l'article
                $articles[$articleId]['prices'][$row['signs']] = $row['price'];
            }
            $queryResult = $articles;
        }
    }

    // Articles les moins chers dans toutes les enseignes
    else {
        $queryResult = array();

        // affiche tous les articles correspondant à tous les menus de la personne et uniquement les moins chers
        foreach ($articles as $article) {
            $query = "SELECT articles.id, articles.name, articles.quantity, articles.description, articles.unity, signs.name AS signs, signs_has_articles.price
                    FROM articles
                    /* Source : https://sql.sh/cours/sous-requete */
                    LEFT JOIN (
                        SELECT articles_id, MIN(price) AS minimumPrice  /* Source : https://www.w3schools.com/sql/sql_min_max.asp */
                        FROM signs_has_articles
                        GROUP BY articles_id
                    ) AS minimumPrices ON articles.id = minimumPrices.articles_id
                    LEFT JOIN signs_has_articles ON articles.id = signs_has_articles.articles_id AND minimumPrices.minimumPrice = signs_has_articles.price
                    LEFT JOIN signs ON signs.id = signs_has_articles.signs_id
                    WHERE articles.id = " . $article['id'] . ";";

            $articles = executeQuerySelect($query);
            $queryResult = array_merge($queryResult, $articles); // Source : https://www.php.net/manual/en/function.array-merge.php
        }
    }

    $articlesList = $queryResult;
    return $articlesList;
}

function createShoppingList()
{
    // Créer une liste de commissions si elle n'existe pas
    $queryResult = NULL;
    $query = "SELECT id FROM `shopping lists` WHERE name = " . $_SESSION['id'] . ";";
    $idShoppingList = executeQuerySelect($query);

    if ($queryResult != NULL) {
        $query = "INSERT INTO `shopping lists` (name) VALUES (" . $_SESSION['id'] . ");";
        executeQueryInsert($query);

        $query = "SELECT id FROM `shopping lists` WHERE name = " . $_SESSION['id'] . ";";
        $idShoppingList = executeQuerySelect($query);
    }

    // ajouter les articles dans la liste de commissions
    // Récupère tous les recettes (id) de tous les menus de la personne connectée
    $query = "SELECT menus_has_foods.foods_id 
                FROM menus_has_foods 
                INNER JOIN menus ON menus_has_foods.menus_id = menus.id
                WHERE menus.accounts_id = " . $_SESSION['id'] . ";";

    $foods = executeQuerySelect($query);


    // Récupère tous les articles des recettes
    $articles = array();
    foreach ($foods as $food) {
        $query = "SELECT foods_has_articles.articles_id, foods_has_articles.quantity
                FROM foods_has_articles
                WHERE foods_has_articles.foods_id = " . $food['foods_id'] . ";";

        $queryResult = executeQuerySelect($query);

        foreach ($queryResult as $row) {
            $articleId = $row['articles_id'];
            // Permet de rassembler les articles qui ont le même id dans une même ligne
            if (!isset($articles[$articleId])) {
                $articles[$articleId] = array(
                    'id' => $row['articles_id'],
                    'quantity' => $row['quantity']
                );
            } else {
                $articles[$articleId]['quantity'] += $row['quantity'];
            }
        }
    }

    // récupère les articles à ajouter dans la liste de commissions
    $queryResult = array();

    foreach ($articles as $article) {
        $query = "SELECT articles.id
                        FROM articles
                        WHERE articles.id = " . $article['id'] . ";";

        $articles = executeQuerySelect($query);
        $queryResult = array_merge($queryResult, $articles); // Source : https://www.php.net/manual/en/function.array-merge.php
    }

    // ajoute les articles dans la liste de commissions
    foreach ($queryResult as $article) {
        $query = "INSERT INTO `articles_has_shopping lists` (articles_id, `shopping lists_id`) VALUES (" . $article['id'] . ", " . $idShoppingList[0]['id'] . ");";
        executeQueryInsert($query);
    }
}

/*
function deleteArticleInShoppingList($articleId)
{
    $query = "DELETE FROM shopping_list_has_articles WHERE shopping_list_id = " . $_SESSION['shoppingListId'] . " AND articles_id = " . $articleId . ";";
    executeQueryDelete($query);
}*/