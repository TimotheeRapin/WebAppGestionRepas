<?php
/**
 * Project                  TPI - Application web pour la gestion des repas en lien avec les commissions et le budget
 * @file                    users.php
 * @brief                   This file is designed to manage the users
 * @author                  Created by Timothée RAPIN
 * Creation date            09.05.2023
 * update                   09.05.2023
 * @version                 1.0
 */

// Start output buffering
ob_start();

// Define the title of the page
$title = 'Application web pour la gestion des repas en lien avec les commissions et le budget - Connexion';
?>

<?php if (isset($loginErrorMessage)) : ?>
    <div class="popup">
        <h2>
            Erreur de connexion
        </h2>
        <div>
            <?=$loginErrorMessage;?>
        </div>
        <br>
        <input type="submit" value="OK" id="btnClose" class="btnClose">
    </div>
<?php endif ?>
    <!-- Page content -->
    <div id="page" class="container">
        <h1>Connexion</h1>


        <form class="login" action="index.php?action=login" method="post" >

            <div data-validate = "une adresse E-mail est obligatoire: ex@abc.xyz">
                <input type="text" name="inputUserEmailAddress" placeholder="Adresse email" value="<?php if( isset($_POST['inputUserEmailAddress'])) {echo $_POST['inputUserEmailAddress'];}?>"/>
            </div>

            <div data-validate = "un mot de passe est obligatoire">
                <input type="password" name="inputUserPsw" placeholder="Mot de passe">
            </div>

            <div>
                <button class="buttonCenter" type="submit">
                    Se connecter
                </button>
            </div>

            <div>
                <a href="index.php?action=register">
                    Je n'ai pas de compte
                </a>
            </div>
        </form>
    </div>

<?php
// Store the buffered content in a variable
$content = ob_get_clean();

// Require the layout file 'gabarit.php'
require 'gabarit.php';
?>