<?php ob_start();?>


<?php
    foreach($requeteDetailFilm->fetchAll() as $info){ ?>
        <p> Année de sortie: <?=$info["annee_sortie"]?>
        <p> Durée: <?=$info["duree"]?> minutes
        <p> Synopsis: <?=$info["synopsis"]?>
        <p> Note: <?=$info["note"]?>
        <p> Réalisateur: <a href="index.php?action=detailRealisateur&id=<?=$info["id_realisateur"]?>"><?=$info["prenom"] ." ".$info["nom"]?></a>
        <p> Genre: <a href="index.php?action=pageGenre&id=<?=$info["id_genre"]?>"><?=$info["nom_genre"]?></a>
    <?php } ?>

<table class="uk-table uk-table-striped">
    <tbody>
        <?php
            foreach($requeteCasting->fetchAll() as $cast){ ?>
                <tr>
                    <td>
                        <a href="index.php?action=detailActeur&id=<?=$cast["id_acteur"]?>"><?= $cast["prenom"]." ".$cast["nom"]?></a> dans le rôle de <a href="index.php?action=detailRole&id=<?=$cast["id_role"]?>"><?= $cast["nom_role"] ?></a>
                    </td>
                </tr>
            <?php } ?>
    </tbody>
</table>

<?php
$titre = $info["nom_film"];
$titre_secondaire = $info["nom_film"];
$contenu = ob_get_clean();
require "view/template.php";