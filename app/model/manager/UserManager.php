<?php
require_once(__DIR__."/../abstract/Manager.php");
require_once(__DIR__."/../entity/User.php");

class UserManager extends Manager {
    //constructor & destructor
    public function __construct($dbName, $dbUser = 'root', $dbPass = '', $charset = 'utf8') {
        parent::__construct($dbName, $dbUser, $dbPass, $charset);
    }

    public function __destruct() {
        parent::__destruct();
    }

    
    public function getUserById($id) {

    }
    
    public function getUserByName($name) {
        
        return new User();
    }

    public function isUsedName($name) {

        return false;
    }

    public function addUser($userInstance) {

        return $userInstance;
    }
}