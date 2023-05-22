<?php
/**
 * Project                  TPI - Application web pour la gestion des repas en lien avec les commissions et le budget
 * @file                    foodForm.php
 * @brief                   This file is designed to creat or modify a food
 * @author                  Created by Timothée RAPIN
 * Creation date            15.05.2023
 * update                   15.05.2023
 * @version                 0.1
 * @note                    Creation of this file
 */

// Start output buffering
ob_start();

// Define the title of the page
$title = "Application web pour la gestion des repas en lien avec les commissions et le budget - Création d'un repas";
?>

    <!-- Page content -->
    <main id="page" class="container">
        <h1>Repas</h1>

        <?php if (isset($foodErrorMessage)): ?>
            <div class="error">
                <?= $foodErrorMessage ?><br><br>
            </div>
        <?php endif; ?>

        <form class="login" action="index.php?action=foodsAdd" method="post" >

            <div data-validate = "un nom de repas est obligatoire">
                <input type="text" name="inputFoodName" placeholder="Nom de du repas" value="<?php if( isset($_POST['inputFoodName'])) {echo $_POST['inputFoodName'];}?>" autofocus/>
            </div>

            <div data-validate="un nombre de personnes est obligatoire" style="display: none;">
                <input type="number" name="inputFoodNbPersons" placeholder="Nombre de personnes" value="1" required/>
            </div>

            <!--
                        <div>
                            <input type="time" name="inputFoodTime" placeholder="Durée de préparation" value="<?php if( isset($_POST['inputFoodTime'])) {echo $_POST['inputFoodTime'];}?>"/>
                        </div>
            -->
            <div>
                <label for="inputFoodDifficulty">Difficulté</label>
                <input type="range" min="1" max="3" step="1" value="2" name="inputFoodDifficulty" value="<?php if( isset($_POST['inputFoodDifficulty'])) {echo $_POST['inputFoodDifficulty'];}?>"/>
            </div>

            <div data-validate ="une instruction est obligatoire">
                <textarea name="inputFoodInstruction" placeholder="Instructions"><?php if( isset($_POST['inputFoodInstruction'])) {echo $_POST['inputFoodInstruction'];}?></textarea>
            </div>

            <div>
                <select name="inputFoodType" <?php if( isset($_POST['inputFoodType'])) {echo $_POST['inputFoodType'];}?>>
                    <option value="0">Type de repas</option>
                    <option value="Starter">Entrée</option>
                    <option value="Dish">Plat</option>
                    <option value="Dessert">Dessert</option>
                </select>
            <div>
                <button class="buttonCenter" type="submit">
                    Ajouter/Modifier
                </button>
            </div>
        </form>
    </main>

<?php
// Store the buffered content in a variable
$content = ob_get_clean();

// Require the layout file 'gabarit.php'
require 'gabarit.php';
?>