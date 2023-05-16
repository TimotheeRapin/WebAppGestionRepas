<?php
/**
 * Project                  TPI - Application web pour la gestion des repas en lien avec les commissions et le budget
 * @file                    menuForm.php
 * @brief                   This file is designed to create or modify a menu
 * @author                  Created by Timothée RAPIN
 * Creation date            16.05.2023
 * update                   16.05.2023
 * @version                 0.1
 * @note                    Creation of this file
 */

// Start output buffering
ob_start();

// Define the title of the page
$title = "Application web pour la gestion des repas en lien avec les commissions et le budget - Création d'un menu";
?>


<!-- Page content -->
<main id="page" class="container">
    <h1>Gestion d'un menu</h1>

    <?php if (isset($menuErrorMessage)): ?>
        <div class="error">
            <?= $menuErrorMessage ?><br><br>
        </div>
    <?php endif; ?>

    <form class="login" action="index.php?action=menusAdd" method="POST">
        <input type="label" name="inputMenuTitle" placeholder="Titre du menu" value="<?php if( isset($_POST['inputMenuTitle'])) {echo $_POST['inputMenuTitle'];}?>" autofocus/><br>

        <select name="inputMenuFood" id="inputMenuFood" <?php if( isset($_POST['inputFood'])) {echo $_POST['inputFood'];}?>>
            <option value="0">Choisir un plat</option>
            <?php foreach ($foods as $food): ?>
                <option value="<?=$food['id']; ?>"><?=$food['name']; ?></option>
            <?php endforeach; ?>
        </select><br>

        <input type="number" name="inputMenuNbPersons" placeholder="Nombre de personnes" value="<?php if( isset($_POST['inputMenuNbPersons'])) {echo $_POST['inputMenuNbPersons'];}?>"/><br>

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