<?php
require_once(__DIR__."/../abstract/Manager.php");
require_once(__DIR__."/../entity/Theme.php");

class ThemeManager extends Manager {
    //constructor & destructor
    public function __construct($dbName, $dbUser = 'root', $dbPass = '', $charset = 'utf8') {
        parent::__construct($dbName, $dbUser, $dbPass, $charset);
    }

    public function __destruct() {
        parent::__destruct();
    }

    public function getById($idTheme){
        
        return new Theme();
    }
    
}