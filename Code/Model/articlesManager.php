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
    $query = "SELECT articles.id, articles.name, articles.quantity, articles.description, articles.unity FROM articles ORDER BY articles.name ASC";
    $queryResult = executeQuerySelect($query);

    foreach ($queryResult['id'] as $articleId){
        foreach ($signs as $sign){
            $query = "SELECT signs_has_articles.price FROM signs_has_articles WHERE signs_has_articles.id_articles = " . $articleId . " AND signs_has_articles.id_signs = " . $sign['id'];
            $price = executeQuerySelect($query);
            $queryResult[$articleId]['price'] = $price[$articleId]['price'];
        }
    }

    return $queryResult;
}
