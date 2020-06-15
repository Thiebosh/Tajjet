<?php
require_once(__DIR__."/../abstract/Manager.php");
require_once(__DIR__."/../entity/Health.php");

class HealthManager extends Manager {
    //constructor & destructor
    public function __construct($dbName, $dbUser = 'root', $dbPass = '', $charset = 'utf8') {
        parent::__construct($dbName, $dbUser, $dbPass, $charset);
    }

    public function __destruct() {
        parent::__destruct();
    }

    public function getLast7Days($idUser){
        //$datasCollectedForLast7Days=
        return new Health($datasCollectedForLast7Days);
    }

    public function addToday($idUser){
        //$datasToAdd=
    }

    
}   