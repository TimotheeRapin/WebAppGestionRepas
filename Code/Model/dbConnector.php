<?php
/**
 * Projet                   TPI - Application web pour la gestion des repas en lien avec les commissions et le budget
 * @file                    dbConnector.php
 * @brief                   This file is designed to manage the connection to the database
 * @author                  Created by Timothée RAPIN
 * Date de création         09.05.2023
 * update                   09.05.2023
 * @version                 1.0
 * @note                    add the function to execute a query update
 */


/**
 * @brief  This function is designed to exeute a query received as parameter
 * @param $query
 * @return null
 * @link  https://php.net/manual/en/pdo.prepare.php
 */
function executeQuerySelect($query)
{
    $queryResult = null;

    $dbConnexion = openDBConnexion();
    if ($dbConnexion != null) {
        $statement = $dbConnexion->prepare($query);     // Préparation de la requête
        $statement->execute();                          // Exécution de la requête
        $queryResult = $statement->fetchAll();          // Préparation des résultats pour le client
    }
    $dbConnexion = null;                                // Fermeture de ma connection à la DB
    return $queryResult;
}

/**
 * @brief Permet d'executer des requêtes d'insertion
 * @brief This function is designed to execute a query insert
 * @param $query
 * @return null
 */
function executeQueryInsert($query)
{
    $queryResult = null;

    $dbConnexion = openDBConnexion();                  // Ouvre la connection à la BD
    if ($dbConnexion != null) {
        $statement = $dbConnexion->prepare($query);     // Préparation de la requête
        $statement->execute();                          // Execution de la requête
        $queryResult = true;
    }
    $dbConnexion = null;                                // Fermeture de ma connection à la DB
    return $queryResult;
}

/**
 * @brief This function is designed to execute a query update
 * @param $query
 * @return true|null
 */
function executeQueryUpdate($query)
{
    $queryResult = null;

    $dbConnexion = openDBConnexion();                  // Ouvre la connection à la BD
    if ($dbConnexion != null) {
        $statement = $dbConnexion->prepare($query);     // Préparation de la requête
        $statement->execute();                          // Execution de la requête
        $queryResult = true;
    }
    $dbConnexion = null;                                // Fermeture de ma connection à la DB
    return $queryResult;
}

/**
 * @brief This function is designed to execute a query delete
 * @param $query
 * @return true|null
 */
function executeQueryDelete($query)
{
    $queryResult = null;

    $dbConnexion = openDBConnexion();                  // Ouvre la connection à la BD
    if ($dbConnexion != null) {
        $statement = $dbConnexion->prepare($query);     // Préparation de la requête
        $statement->execute();                          // Execution de la requête
        $queryResult = true;
    }
    $dbConnexion = null;                                // Fermeture de ma connection à la DB
    return $queryResult;
}


/**
 * @brief This function is designed to open a connection to the database
 * @return PDO|null
 */
function openDBConnexion()
{
    $tempDBConnexion = null;

    $sqlDriver = 'mysql';
    $hostname = 'localhost';
    $port = 3306;
    $charset = 'utf8';
    $dbName = 'gesrep_trn_TPI';
    $userName = 'gesrep_trn_TPI';
    $userPsw = '6@aP7qkR8^hn';
    $dsn = $sqlDriver . ':host=' . $hostname . ';dbname=' . $dbName . ';port=' . $port . ';charset=' . $charset;

    try {
        $tempDBConnexion = new PDO($dsn, $userName, $userPsw);
    } catch (PDOException $exception) {
        echo 'Connection failed' . $exception->getMessage();
    }

    return $tempDBConnexion;
}

// Class for managing exceptions related to the model
class ModelDataException extends Exception
{

}