<?php 
session_start();
ob_start(); 
?>

        <form action="index.php?action=addActeur" method="post">
            <p> Informations de l'acteur :<br> 
                <label>
                    Nom :
                    <input type="text" name="nom">
                </label>
            </p>
            <p>
                <label>
                    Prenom :
                    <input type="text" name="prenom">
                </label>
            </p>
            <p>
                <label>
                    Sexe :
                    <input type="text" name="sexe">
                </label>
            </p>
            <p>
                <label>
                    Date de naissance :
                    <input type="date" name="date_naissance">
                </label>
            </p>
            
            <p>
                <input type="submit" name="submit" value="Ajouter l'acteur">
            </p>

        </form>

<?php

$titre = "Ajouter acteur";
$titre_secondaire = "Ajouter acteur";
$contenu = ob_get_clean();
require "template.php";