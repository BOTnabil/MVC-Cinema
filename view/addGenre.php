<?php 
session_start();
ob_start(); 
?>

<h1>Ajouter un genre</h1>
        <form action="index.php?action=addGenre" method="post">
            <p>
                <label>
                    Nom du genre :
                    <input type="text" name="nom_genre">
                </label>
            </p>
            <p>
                <input type="submit" name="submit" value="Ajouter le genre">
            </p>

        </form>

<?php

$titre = "Ajouter genre";
$titre_secondaire = "Ajouter genre";
$contenu = ob_get_clean();
require "template.php";