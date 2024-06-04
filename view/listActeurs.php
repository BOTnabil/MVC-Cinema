<?php ob_start(); ?>

<p class="uk-label uk-label-warning">Il y a <?= $requete->rowCount() ?> acteurs</p>

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
            foreach($requete->fetchAll() as $acteur){ ?>
                <tr>
                    <td><a href="index.php?action=detailActeur&id=<?=$acteur["id_acteur"]?>"><?= $acteur["prenom"] ?></a></td>
                    <td><a href="index.php?action=detailActeur&id=<?=$acteur["id_acteur"]?>"><?= $acteur["nom"] ?></a></td>
                    <td><?= $acteur["date_naissance_formatee"] ?></td>
                </tr>
            <?php } ?>
    </tbody>
</table>

<?php

$titre = "Liste des acteurs";
$titre_secondaire = "Liste des acteurs";
$contenu = ob_get_clean();
require "view/template.php";