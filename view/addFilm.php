<?php 
session_start();
ob_start(); 
?>

        <form action="index.php?action=addFilm" method="post">
            <p> Informations de l'acteur :<br> 
                <label>
                    Titre :
                    <input type="text" name="nom_film">
                </label>
            </p>
            <p>
                <label>
                    Année de sortie :
                    <input type="number" name="annee_sortie">
                </label>
            </p>
            <p>
                <label>
                    Durée en minute :
                    <input type="number" name="duree">
                </label>
            </p>
            <p>
                <label>
                    Synopsis :
                    <input type="text" name="synopsis">
                </label>
            </p>
            <p>
                <label>
                    Realisateur :
                    <input type="text" name="realisateur">
                </label>
            </p>
            <p>
                <input type="submit" name="submit" value="Ajouter le film">
            </p>
            

        </form>

<?php

$titre = "Ajouter film";
$titre_secondaire = "Ajouter film";
$contenu = ob_get_clean();
require "template.php";