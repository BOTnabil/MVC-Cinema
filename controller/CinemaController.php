<?php

namespace Controller; 
use Model\Connect;

class CinemaController {
    /**
    * Lister les films
    */
    public function listFilms() {
        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT nom_film, annee_sortie, id_film
            FROM film
            ORDER BY annee_sortie DESC
            ");
            
        require "view/listFilms.php";
    }

    public function detailFilm($id) {
        $pdo = Connect::seConnecter();
        $requeteDetailFilm = $pdo->prepare("
            SELECT f.nom_film, f.annee_sortie, f.duree, f.synopsis, f.note, f.affiche, p.prenom, p.nom, f.id_realisateur, g.nom_genre, f.id_film, g.id_genre
            FROM film f
            INNER JOIN realisateur r ON r.id_realisateur = f.id_realisateur
            INNER JOIN personne p ON p.id_personne = r.id_personne
            INNER JOIN appartient a ON a.id_film = f.id_film
            INNER JOIN genre g ON g.id_genre = a.id_genre
            WHERE f.id_film = :id
        ");
        $requeteDetailFilm->execute(["id" => $id]);

        $requeteCasting = $pdo->prepare("
            SELECT p.prenom, p.nom, r.nom_role, c.id_acteur, r.id_role
            FROM casting c
            INNER JOIN film f ON f.id_film = c.id_film
            INNER JOIN acteur a ON a.id_acteur = c.id_acteur
            INNER JOIN role r ON r.id_role = c.id_role
            INNER JOIN personne p ON p.id_personne = a.id_personne
            WHERE f.id_film = :id
            ORDER BY p.nom ASC
        ");
        $requeteCasting->execute(["id" => $id]);

        require "view/detailFilm.php";
    }

    public function listActeurs() {
        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT p.prenom, p.nom, DATE_FORMAT(p.date_naissance, '%d/%m/%Y') AS date_naissance_formatee, a.id_acteur
            FROM acteur a
            INNER JOIN personne p ON p.id_personne = a.id_personne
            ORDER BY p.nom ASC
        ");

        require "view/listActeurs.php";
    }

    public function detailActeur($id) {
        $pdo = Connect::seConnecter();
        $requeteDetailActeur = $pdo->prepare("
        SELECT p.prenom, p.nom, DATE_FORMAT(p.date_naissance, '%d/%m/%Y') AS date_naissance_formatee, p.sexe
        FROM acteur a
        INNER JOIN personne p ON p.id_personne = a.id_personne
        WHERE a.id_acteur = :id
        ");
        $requeteDetailActeur->execute(["id" => $id]);

        $requeteListFilmsActeur = $pdo->prepare("
        SELECT f.nom_film, f.annee_sortie, r.nom_role, f.id_film, c.id_role
        FROM casting c
        INNER JOIN acteur a ON a.id_acteur = c.id_acteur
        INNER JOIN film f ON f.id_film = c.id_film
        INNER JOIN role r ON r.id_role = c.id_role
        WHERE c.id_acteur = :id
        ORDER BY f.annee_sortie DESC
        ");
        $requeteListFilmsActeur->execute(["id" => $id]);
        
        require "view/detailActeur.php";
    }

    public function listRealisateurs() {
        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT p.prenom, p.nom, DATE_FORMAT(p.date_naissance, '%d/%m/%Y') AS date_naissance_formatee, r.id_realisateur
            FROM realisateur r
            INNER JOIN personne p ON p.id_personne = r.id_personne
            ORDER BY p.nom ASC
        ");

        require "view/listRealisateurs.php";
    }

    public function detailRealisateur($id) {
        $pdo = Connect::seConnecter();
        $requeteRealisateur = $pdo->prepare("
        SELECT p.prenom, p.nom, DATE_FORMAT(p.date_naissance, '%d/%m/%Y') AS date_naissance_formatee, p.sexe
        FROM personne p
        INNER JOIN realisateur r ON r.id_personne = p.id_personne
        WHERE r.id_realisateur = :id
        ");
        $requeteRealisateur->execute(["id" => $id]);

        $requeteFilms = $pdo->prepare("
        SELECT f.nom_film, f.annee_sortie, f.id_film
        FROM film f
        INNER JOIN realisateur r ON r.id_realisateur = f.id_realisateur
        INNER JOIN personne p ON p.id_personne = r.id_personne
        WHERE r.id_realisateur = :id
        ORDER BY f.annee_sortie DESC
        ");
        $requeteFilms->execute(["id" => $id]);
        
        require "view/detailRealisateur.php";
    }

    public function listGenres() {
        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT nom_genre, id_genre
            FROM genre
            ORDER BY nom_genre ASC
        ");

        require "view/listGenres.php";
    }

    public function listRoles() {
        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("
            SELECT nom_role, id_role
            FROM role
            ORDER BY nom_role ASC
        ");
        $requete->execute();

        require "view/listRoles.php";
    }

    public function detailRole($id) {
        $pdo = Connect::seConnecter();
        $requeteRole = $pdo->prepare("
            SELECT nom_role
            FROM role
            WHERE id_role = :id
        ");
        $requeteRole->execute(["id" => $id]);

        $requeteFilm = $pdo->prepare("
        SELECT p.prenom, p.nom, f.nom_film, f.annee_sortie, f.id_film, c.id_acteur
        FROM casting c
        INNER JOIN acteur a ON a.id_acteur = c.id_acteur
        INNER JOIN film f ON f.id_film = c.id_film
        INNER JOIN personne p ON p.id_personne = a.id_personne
        WHERE c.id_role = :id
        ORDER BY p.nom ASC
        ");
        $requeteFilm->execute(["id" => $id]);

        require "view/detailRole.php";
    }

    public function addGenre() {
        if(isset($_POST['submit'])){
            // var_dump("ok");die;
            $name = filter_input(INPUT_POST, "nom_genre", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $pdo = Connect::seConnecter();
            $requete = $pdo->prepare("
                INSERT INTO genre (nom_genre) VALUES
                (:nom_genre);
            ");
            $requete->execute([
                "nom_genre" => $name
            ]);

            header("Location: index.php?action=listGenres");

        }
        require "view/addGenre.php";
    }

    public function addRole() {
        if(isset($_POST['submit'])){
            // var_dump("ok");die;
            $name = filter_input(INPUT_POST, "nom_role", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $pdo = Connect::seConnecter();
            $requete = $pdo->prepare("
                INSERT INTO role (nom_role) VALUES
                (:nom_role);
            ");
            $requete->execute([
                "nom_role" => $name
            ]);

            header("Location: index.php?action=listRoles");

        }
        require "view/addRole.php";
    }

    public function addActeur() {
        if(isset($_POST['submit'])){
            // var_dump("ok");die;
            $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sexe = filter_input(INPUT_POST, "sexe", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $date_naissance = filter_input(INPUT_POST, "date_naissance");
            $pdo = Connect::seConnecter();
            $requete1 = $pdo->prepare("
                INSERT INTO personne (nom, prenom, sexe, date_naissance) VALUES
                (:nom, :prenom, :sexe, :date_naissance);
            ");
            $requete1->execute([
                "nom" => $nom, "prenom" => $prenom, "sexe" => $sexe, "date_naissance" => $date_naissance
            ]);

            $dernier_id = $pdo->lastInsertId();

            $requete2 = $pdo->prepare("
                INSERT INTO acteur (id_personne) VALUES  
                (:id_personne)
            ");
            
            $requete2->execute([
                ':id_personne' => $dernier_id
            ]);

            header("Location: index.php?action=listActeurs");

        }
        require "view/addActeur.php";
    }

    public function addRealisateur() {
        if(isset($_POST['submit'])){
            // var_dump("ok");die;
            $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sexe = filter_input(INPUT_POST, "sexe", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $date_naissance = filter_input(INPUT_POST, "date_naissance");
            $pdo = Connect::seConnecter();
            $requete1 = $pdo->prepare("
                INSERT INTO personne (nom, prenom, sexe, date_naissance) VALUES
                (:nom, :prenom, :sexe, :date_naissance);
            ");
            $requete1->execute([
                "nom" => $nom, "prenom" => $prenom, "sexe" => $sexe, "date_naissance" => $date_naissance
            ]);

            $dernier_id = $pdo->lastInsertId();

            $requete2 = $pdo->prepare("
                INSERT INTO realisateur (id_personne) VALUES  
                (:id_personne)
            ");
            
            $requete2->execute([
                ':id_personne' => $dernier_id
            ]);

            header("Location: index.php?action=listRealisateurs");

        }
        require "view/addRealisateur.php";
    }

    public function addFilm() {
        if(isset($_POST['submit'])){
            // var_dump("ok");die;
            $nom_film = filter_input(INPUT_POST, "nom_film", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $annee_sortie  = filter_input(INPUT_POST, "annee_sortie");
            $synopsis = filter_input(INPUT_POST, "synopsis", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $duree = filter_input(INPUT_POST, "duree");
            $note = filter_input(INPUT_POST, "note");
            $nom_realisateur = filter_input(INPUT_POST, "realisateur", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $pdo = Connect::seConnecter();
            $requeteFilm = $pdo->prepare("
                INSERT INTO film (nom_film, annee_sortie, synopsis, duree, note, id_realisateur) VALUES
                (:nom_film, :annee_sortie, :synopsis, :duree, :note 
                    ( SELECT personne.prenom, personne.nom
                       FROM realisateur 
                       INNER JOIN
                       WHERE :nom_realisateur );
            ");
            $requeteFilm->execute([
                "nom_film" => $nom_film, "annee_sortie" => $annee_sortie, "synopsis" => $synopsis, "duree" => $duree, "note" => $note
            ]);

            $dernier_id = $pdo->lastInsertId();

            $requeteGenre = $pdo->prepare("
                INSERT INTO appartient (id_film, id_genre) VALUES  
                (:id_personne)
            ");
            
            $requeteGenre->execute([
                ':id_film' => $dernier_id
            ]);

            $requeteCasting = $pdo->prepare("
                INSERT INTO casting (id_film) VALUES  
                (:id_film)
            ");
            
            $requeteCasting->execute([
                ':id_film' => $dernier_id
            ]);

            header("Location: index.php?action=listFilms");

        }
        require "view/addFilm.php";
    }
}