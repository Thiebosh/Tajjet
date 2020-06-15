<?php
require_once(__DIR__."/../abstract/Manager.php");
require_once(__DIR__."/../entity/Muscle.php");

class MuscleManager extends Manager {
    //constructor & destructor
    public function __construct($dbName, $dbUser = 'root', $dbPass = '', $charset = 'utf8') {
        parent::__construct($dbName, $dbUser, $dbPass, $charset);
    }

    public function __destruct() {
        parent::__destruct();
    }

    public function getAllById($idMuscle){
        
        return array( new Muscle() );
    }
    public function getAllMuscles(){
        
        return array( new Muscle() );
    }
    
}