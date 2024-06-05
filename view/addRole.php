<?php 
session_start();
ob_start(); 
?>

        <form action="index.php?action=addRole" method="post">
            <p>
                <label>
                    Nom du role :
                    <input type="text" name="nom_role">
                </label>
            </p>
            <p>
                <input type="submit" name="submit" value="Ajouter le role">
            </p>

        </form>

<?php

$titre = "Ajouter role";
$titre_secondaire = "Ajouter role";
$contenu = ob_get_clean();
require "template.php";