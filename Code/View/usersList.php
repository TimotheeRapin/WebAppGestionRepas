<?php
/**
 * Project                  TPI - Application web pour la gestion des repas en lien avec les commissions et le budget
 * @file                    usersList.php
 * @brief                   This file is designed to display the users list page
 * @author                  Created by Timothée RAPIN
 * Date de création         09.05.2023
 * update                   11.05.2023
 * @version                 1.0
 * @note                    delete users
 */

// Start output buffering
ob_start();

// Define the title of the page
$title = 'Application web pour la gestion des repas en lien avec les commissions et le budget - Liste des utilisateurs';
?>

    <!-- Page content -->
    <main id="page" class="container">
        <h1>Liste des comptes</h1>

        <h2>Utilisateurs</h2>
        <table class="userList">
            <thead>
            <tr>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Email</th>
                <!--
                <th>Modifier</th>
                -->
                <th>Supprimer</th>
            </tr>
            </thead>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?=$user['firstName']; ?></td>
                    <td><?=$user['lastName']; ?></td>
                    <td><?=$user['email']; ?></td>
                    <!--
                    <td>
                        <a href="index.php?action=updateUser&id=<?=$user['id']; ?>">
                            <button>Modifier</button>
                        </a>
                    </td>
                    -->
                    <td>
                        <a href="index.php?action=usersDelete&id=<?=$user['id']; ?>">
                            <button>Supprimer</button>
                            <!-- SVG delete icon --><!--
                            <svg width="100" height="100">
                                <polygon
                                        points="
                                        0 30
                                        10 100
                                        90 100
                                        100 30
                                        0 0
                                        0 10
                                        70 30
                                        "
                                        style="fill:white;stroke:black;stroke-width:1"
                                />
                            </svg>-->


                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <a href="index.php?action=usersAdd&type=User">
            <button>Ajouter un utilisateur</button>
        </a>

        <h2>Administrateurs</h2>
        <table class="userList">
            <thead>
            <tr>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Email</th>
                <!--
                <th>Modifier</th>
                -->
                <th>Supprimer</th>
            </tr>
            </thead>
            <?php foreach ($administrators as $administrator): ?>
                <tr>
                    <td><?=$administrator['firstName']; ?></td>
                    <td><?=$administrator['lastName']; ?></td>
                    <td><?=$administrator['email']; ?></td>
                    <!--
                    <td>
                        <a href="index.php?action=userUpdate&id=<?=$administrator->id; ?>">
                            <button>Modifier</button>
                        </a>
                    </td>
                    -->
                    <td>
                        <a href="index.php?action=usersDelete&id=<?=$administrator['id']; ?>">
                            <button>Supprimer</button>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <!--
        <a href="index.php?action=usersAdd&type=Administrator">
            <button>Ajouter un administrateur</button>
        </a>
        -->
    </main>


<?php
// Store the buffered content in a variable
$content = ob_get_clean();

// Require the layout file 'gabarit.php'
require 'gabarit.php';
?>