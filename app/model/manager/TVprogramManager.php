<?php
require_once(__DIR__."/../abstract/Manager.php");
require_once(__DIR__."/../entity/TVprogram.php");

class TVprogramManager extends Manager {
    //constructor & destructor
    public function __construct($dbName, $dbUser = 'root', $dbPass = '', $charset = 'utf8') {
        parent::__construct($dbName, $dbUser, $dbPass, $charset);
    }

    public function __destruct() {
        parent::__destruct();
    }

    public function getAllAfterTime($time){ //Pour afficher le programme selon l'heure saisie par l'utilisateur
        
        return array( new TVprogam() );
    }

    public function getAllForDay($date){ //Pour afficher le programme de la journée par défaut
        
        return array( new TVprogam() );
    }
    

}