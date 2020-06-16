<?php
require_once(__DIR__."/../abstract/Manager.php");
require_once(__DIR__."/../entity/Sport.php");

class SportManager extends Manager {
    //constructor & destructor
    public function __construct($dbName, $dbUser = 'root', $dbPass = '', $charset = 'utf8') {
        parent::__construct($dbName, $dbUser, $dbPass, $charset);
    }

    public function __destruct() {
        parent::__destruct();
    }
    
    public function getAll(){ //Pour afficher la liste de tous les exercices si clic sur "liste d'exercices"
    
        return array( new Sport() );
    }

    public function getAllByIdMuscle($idMuscle){
        

        return array( new Sport() );
    }
    
    public function getAllByLabelSport($labelSport){ //Pour la recherche par nom d'exercice
        

        return array( new Sport() );
    }

    public function getAllByIdUser($idUser){ //Pour pouvoir afficher la séance de l'utilisateur à sa prochaine connexion
        

        return array( new Sport() );
    }
}