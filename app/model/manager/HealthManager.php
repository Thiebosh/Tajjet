<?php
require_once(__DIR__."/../abstract/Manager.php");
require_once(__DIR__."/../entity/Health.php");

class HealthManager extends Manager {
    //constructor & destructor
    /*public function __construct($dbName, $dbUser = 'root', $dbPass = '', $charset = 'utf8') {
        parent::__construct($dbName, $dbUser, $dbPass, $charset);
    }*/
    public function __construct() {
    }

    public function __destruct() {
        parent::__destruct();
    }

    public function getAllLast7Days($idUser){
        
        return array( new Health() );
    }

    public function addToday($healthRecord){
        
        return new Health();//gagne un id
    }

    public function updateToday($healthRecord){
        
    }
}   