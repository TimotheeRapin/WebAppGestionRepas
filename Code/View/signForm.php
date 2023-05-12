<?php
/**
 * Project                  TPI - Application web pour la gestion des repas en lien avec les commissions et le budget
 * @file                    signForm.php
 * @brief                   This file is designed to creat or modify a sign
 * @author                  Created by Timothée RAPIN
 * Creation date            11.05.2023
 * update                   11.05.2023
 * @version                 0.1
 * @note                    Creation of this file
 */

// Start output buffering
ob_start();

// Define the title of the page
$title = "Application web pour la gestion des repas en lien avec les commissions et le budget - Inscription";
?>

    <!-- Page content -->
    <main id="page" class="container">
        <h1>Enseigne</h1>

        <?php if (isset($signErrorMessage)): ?>
            <div class="error">
                <?= $signErrorMessage ?><br><br>
            </div>
        <?php endif; ?>

        <form class="login" action="index.php?action=signsAdd" method="post" >

            <div data-validate = "un nom d'enseigne est obligatoire">
                <input type="text" name="inputSignName" placeholder="Nom de l'enseigne" value="<?php if( isset($_POST['inputSignName'])) {echo $_POST['inputSignName'];}?>"/>
            </div>

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