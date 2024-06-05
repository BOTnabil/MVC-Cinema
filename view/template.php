<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/css/style.css">
    <title><?= $titre ?></title>
</head>
<body>
    <nav>
        <ul>
            <li><a href="index.php?action=listFilms">Films</a></li>
            <li><a href="index.php?action=listActeurs">Acteurs</a></li>
            <li><a href="index.php?action=listRealisateurs">Réalisateurs</a></li>
            <li><a href="index.php?action=listGenres">Genres</a></li>
            <li><a href="index.php?action=listRoles">Rôles</a></li>
            <li><a href="index.php?action=addGenre">Ajouter genre</a></li>
            <li><a href="index.php?action=addRole">Ajouter role</a></li>
            <li><a href="index.php?action=addActeur">Ajouter acteur</a></li>
            <li><a href="index.php?action=addRealisateur">Ajouter realisateur</a></li>
            <li><a href="index.php?action=addRealisateur">Ajouter Film</a></li>
        </ul>
    </nav>

    <div id="wrapper">
        <main>
            <div id="contenu">
                <h1>PDO Cinema</h1>
                <h2><?= $titre_secondaire ?></h2>
                <?= $contenu ?>
            </div>
        </main>
    </div>
    
</body>
</html>