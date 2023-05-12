<?php
/**
 * Project                  TPI - Application web pour la gestion des repas en lien avec les commissions et le budget
 * @file                    articlesManager.php
 * @brief                   This file is designed to manage the articles
 * @author                  Created by Timothée RAPIN
 * Creation date            11.05.2023
 * update                   11.05.2023
 * @version                 0.1
 */

// Include the database connection file
require_once "dbConnector.php";

function getArticlesList()
{
    $query = "SELECT articles.id, articles.name, articles.quantity, articles.description, articles.unity, signs.name AS signs, signs_has_articles.price
                FROM articles
                CROSS JOIN signs /* Permet de récupérer toutes les enseignes et ainsi avoir une colonne par enseigne même s il n y a pas de prix dans cete enseigne.
                                    Cela permet de faire un tableau avec toujours la m'ême valeur pour chaque enseignes et éviter les décalages.
                                    Sources : https://www.w3schools.com/mysql/mysql_join_cross.asp*/
                LEFT JOIN signs_has_articles ON articles.id = signs_has_articles.articles_id 
                AND signs.id = signs_has_articles.signs_id
                ORDER BY articles.name ASC;";
    $queryResult = executeQuerySelect($query);


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
        $articles[$articleId]['prices'][] = $row['price'];
    }
    $queryResult = $articles;
    return $queryResult;
}

/**
 * @brief This function is designed to manage the articles
 * @param $data
 * @return void
 */
function articleManage($data){
    $signs = getSignsList();
    try {

        //variable set
        if (isset($data['inputArticleName']) && isset($data['inputArticleQuantity']) && isset($data['inputArticleDescription']) && isset($data['inputArticleUnity'])) {

            $strSeparator = "'";
            //Test si l'article existe déjà (name+quantity)
            $query = "SELECT articles.name, articles.quantity, articles.description, articles.unity FROM articles
                      WHERE articles.name = " . $strSeparator . $data['inputArticleName'] . $strSeparator . "
                        AND articles.quantity = " . $strSeparator . $data['inputArticleQuantity'] . $strSeparator . ";";
            $article = executeQuerySelect($query);

            // Test si l'article existe déjà (name+quantity)
            $existArticle = false;
            if (isset($article) && $article != "" && $article != null && $article != 0) {
                $dataArticle = $article;
                $id = $article['id'];
                $existArticle = true;
            }

            // Si l'article n'existe pas dans la BDD
            if ($existArticle == false) {

                // Si tout les champs sont remplis
                if ($data['inputArticleName'] != "" && $data['inputArticleQuantity'] != "" && $data['inputArticleUnity'] != "") {

                    // Si la quantité est un nombre
                    if (is_numeric($data['inputArticleQuantity'])) {

                        // Si la quantité est positive
                        if ($data['inputArticleQuantity'] > 0) {

                            // Si l'unité est valide
                            if ($data['inputArticleUnity'] == "g" || $data['inputArticleUnity'] == "kg" || $data['inputArticleUnity'] == "ml" || $data['inputArticleUnity'] == "cl" || $data['inputArticleUnity'] == "l" || $data['inputArticleUnity'] == "pce") {

                                // Si l'article à bien été créé dans la BDD
                                if (createArticle($data['inputArticleName'], $data['inputArticleQuantity'], $data['inputArticleDescription'], $data['inputArticleUnity'])) {
                                    $articleErrorMessage = null;
                                    require "View/articlesList.php";
                                } else {
                                    $articleErrorMessage = "L'article n'a pas pu être créé !";
                                    require "View/articleForm.php";
                                }
                            } else {
                                $articleErrorMessage = "L'unité n'est pas valide !";
                                require "View/articleForm.php";
                            }
                        } else {
                            $articleErrorMessage = "La quantité doit être positive !";
                            require "View/articleForm.php";
                        }
                    } else {
                        $articleErrorMessage = "La quantité doit être un nombre !";
                        require "View/articleForm.php";
                    }
                } else {
                    $articleErrorMessage = "Tous les champs doivent être remplis !";
                    require "View/articleForm.php";
                }
            } else {
                $articleErrorMessage = "L'article existe déjà !";
                require "View/articleForm.php";
            }
        } else {
            $articleErrorMessage = null;
            require "View/articleForm.php";
        }

    }
    catch (ModelDataBaseException $ex) {
        $articleErrorMessage = "Nous rencontrons actuellement un problème technique. Il est temporairement impossible de gérer les articles. Désolé du dérangement !";
        require "View/articleForm.php";
    }
}

/**
 * @brief This function is designed to create an article
 * @param $name
 * @param $quantity
 * @param $description
 * @param $unity
 * @return bool
 */
function createArticle($name, $quantity, $description, $unity){
    $result = false;

    $strSeparator = "'";

    $articleAddQuery = "INSERT INTO articles (name, quantity, description, unity)
                        VALUES ('$name', '$quantity', '$description', '$unity');";

    $queryResult = executeQueryInsert($articleAddQuery);
    if ($queryResult){
        $result = $queryResult;

        $articleId = getArticleId($name, $quantity, $unity);

        $articleAddPriceQuery = "INSERT INTO signs_has_articles (signs_id, articles_id, price)
                                VALUES ('$articleSignId', '$articleId', '$articlePrice');";
    }

    return $result;
}