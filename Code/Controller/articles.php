<?php
/**
 * Project                  TPI - Application web pour la gestion des repas en lien avec les commissions et le budget
 * @file                    articles.php
 * @brief                   This file is designed to manage the articles
 * @authors                 Created by Timothée RAPIN
 * creation date            11.05.2023
 * update                   11.05.2023
 * version                  0.1
 * @note                    creation of the file
 */

// Include the model file
require_once "Model/articlesManager.php";

/**
 * @brief This function is designed to display the articles list
 */
function articlesList()
{
    // Get all the articles from the database
    $articles = getArticlesList();

    // Call the view 'articlesList' to display the articles list
    require_once "View/articlesList.php";
}