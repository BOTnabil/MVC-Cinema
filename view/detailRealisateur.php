<?php ob_start();?>

<?php
    foreach($requeteRealisateur->fetchAll() as $info){ ?>
        <p> Date de Naissance: <?=$info["date_naissance_formatee"]?>
        <p> Sexe: <?=$info["sexe"]?>
    <?php } ?>

<table class="uk-table uk-table-striped">
    <thead>
        <tr>
            <th>Film</th>
            <th>Année de sortie en France</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($requeteFilms->fetchAll() as $film){ ?>
                <tr>
                <td><a href="index.php?action=detailFilm&id=<?=$film["id_film"]?>"><?= $film["nom_film"]?></a></td>
                    <td><?= $film["annee_sortie"]?></td>
                </tr>
            <?php } ?>
    </tbody>
</table>

<?php
$titre = $info["prenom"]. " ".$info["nom"];
$titre_secondaire = $info["prenom"]. " ".$info["nom"];
$contenu = ob_get_clean();
require "view/template.php";