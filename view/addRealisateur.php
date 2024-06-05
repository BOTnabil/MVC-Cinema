<?php 
session_start();
ob_start(); 
?>

        <form action="index.php?action=addRealisateur" method="post">
            <p> Informations du réalisateur :<br> 
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
                <input type="submit" name="submit" value="Ajouter le réalisateur">
            </p>

        </form>

<?php

$titre = "Ajouter realisateur";
$titre_secondaire = "Ajouter realisateur";
$contenu = ob_get_clean();
require "template.php";