<?php

use Controller\CinemaController;

spl_autoload_register(function($class_name){
    include $class_name . '.php';
});

$ctrlCinema = new CinemaController();

$id = (isset($_GET["id"])) ? $_GET["id"] : null;

if(isset($_GET["action"])){
    switch ($_GET["action"]) {
        case "listFilms" : $ctrlCinema->listFilms(); break;
        case "listActeurs" : $ctrlCinema->listActeurs(); break;
        case "listRealisateurs" : $ctrlCinema->listRealisateurs(); break;
        case "listGenres" : $ctrlCinema->listGenres(); break;
        case "listRoles" : $ctrlCinema->listRoles(); break;
        case "detailFilm" : $ctrlCinema->detailFilm($id); break;
        case "detailActeur" : $ctrlCinema->detailActeur($id); break;
        case "detailRealisateur" : $ctrlCinema->detailRealisateur($id); break;
        case "detailRole" : $ctrlCinema->detailRole($id); break;
        case "addGenre" : $ctrlCinema->addGenre(); break;
        case "addRole" : $ctrlCinema->addRole(); break;
        case "addActeur" : $ctrlCinema->addActeur(); break;
        case "addRealisateur" : $ctrlCinema->addRealisateur(); break;
        case "addFilm" : $ctrlCinema->addFilm(); break;
    }
}