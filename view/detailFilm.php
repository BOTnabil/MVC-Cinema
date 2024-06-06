<?php ob_start();
$film = $requeteDetailFilm->fetch();
$genres = $requeteGenres->fetchAll();
$casting = $requeteCasting->fetchAll();

?>

<p> Année de sortie: <?=$film["annee_sortie"]?>
<p> Durée: <?=$film["duree"]?> minutes
<p> Synopsis: <?=$film["synopsis"]?>
<p> Note: <?=$film["note"]?>
<p> Réalisateur: <a href="index.php?action=detailRealisateur&id=<?=$film["id_realisateur"]?>"><?=$film["prenom"] ." ".$film["nom"]?></a>
<p> Genre(s): <?php
            foreach($genres as $genre){ ?>
                    <?= $genre["nom_genre"] ?>
            <?php } ?> </p>

<table class="uk-table uk-table-striped">
    <tbody>
        <?php
            foreach($casting as $cast){ ?>
                <tr>
                    <td>
                        <a href="index.php?action=detailActeur&id=<?=$cast["id_acteur"]?>"><?= $cast["prenom"]." ".$cast["nom"]?></a> dans le rôle de <a href="index.php?action=detailRole&id=<?=$cast["id_role"]?>"><?= $cast["nom_role"] ?></a>
                    </td>
                </tr>
            <?php } ?>
    </tbody>
</table>

<?php
$titre = $film["nom_film"];
$titre_secondaire = $film["nom_film"];
$contenu = ob_get_clean();
require "view/template.php";