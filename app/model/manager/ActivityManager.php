<?php
require_once(__DIR__."/../abstract/Manager.php");
require_once(__DIR__."/../entity/Activity.php");

class ActivityManager extends Manager {
    //constructor & destructor
    public function __construct($dbName, $dbUser = 'root', $dbPass = '', $charset = 'utf8') {
        parent::__construct($dbName, $dbUser, $dbPass, $charset);
    }

    public function __destruct() {
        parent::__destruct();
    }

    public function getAllByIdTown($idTown){
        
        return array( new Activity() );
    }
    
}