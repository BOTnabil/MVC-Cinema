<?php ob_start(); ?>

<p class="uk-label uk-label-warning">Il y a <?= $requete->rowCount() ?> réalisateurs</p>

<table class="uk-table uk-table-striped">
    <thead>
        <tr>
            <th>Prénom</th>
            <th>Nom</th>
            <th>Date de naissance</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($requete->fetchAll() as $realisateur){ ?>
                <tr>
                    <td><a href="index.php?action=detailRealisateur&id=<?=$realisateur["id_realisateur"]?>"><?= $realisateur["prenom"] ?></a></td>
                    <td><a href="index.php?action=detailRealisateur&id=<?=$realisateur["id_realisateur"]?>"><?= $realisateur["nom"] ?></a></td>
                    <td><?= $realisateur["date_naissance_formatee"] ?> </td>
                </tr>
            <?php } ?>
    </tbody>
</table>

<?php

$titre = "Liste des réalisateurs";
$titre_secondaire = "Liste des réalisateurs";
$contenu = ob_get_clean();
require "view/template.php";