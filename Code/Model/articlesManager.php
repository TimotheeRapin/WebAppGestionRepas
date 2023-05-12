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
