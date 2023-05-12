<?php
/**
 * Project                  TPI - Application web pour la gestion des repas en lien avec les commissions et le budget
 * @file                    register.php
 * @brief                   This file is designed to display the registration of a new user
 * @author                  Created by Timothée RAPIN
 * Creation date            09.05.2023
 * update                   09.05.2023
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
    <h1>S'inscrire</h1>

    <?php if (isset($registerErrorMessage)): ?>
        <div class="error">
            <?= $registerErrorMessage ?><br><br>
        </div>
    <?php endif; ?>

    <form class="login" action="index.php?action=register" method="post" >

        <div data-validate = "un prénom est obligatoire">
            <input type="text" name="inputUserFirstName" placeholder="Prénom" value="<?php if( isset($_POST['inputUserFirstName'])) {echo $_POST['inputUserFirstName'];}?>"/>
        </div>

        <div data-validate = "un nom est obligatoire">
            <input type="text" name="inputUserLastName" placeholder="Nom" value="<?php if( isset($_POST['inputUserLastName'])) {echo $_POST['inputUserLastName'];}?>"/>
        </div>

        <div data-validate = "une adresse E-mail est obligatoire: ex@abc.xyz">
            <input type="text" name="inputUserEmailAddress" placeholder="Adresse email" value="<?php if( isset($_POST['inputUserEmailAddress'])) {echo $_POST['inputUserEmailAddress'];}?>"/>
        </div>

        <div data-validate = "un mot de passe est obligatoire">
            <input type="password" name="inputUserPsw" placeholder="Mot de passe">
        </div>

        <div data-validate = "une confirmation de mot de passe est obligatoire">
            <input type="password" name="inputUserPswRepeat" placeholder="Confirmation du mot de passe">
        </div>

        <div>
            <button class="buttonCenter" type="submit">
                S'inscrire'
            </button>
        </div>

        <div>
            <a href="index.php?action=login">
                J'ai déjà un compte
            </a>
        </div>
    </form>
</main>

<?php
// Store the buffered content in a variable
$content = ob_get_clean();

// Require the layout file 'gabarit.php'
require 'gabarit.php';
?>