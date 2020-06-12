<?php

abstract class Manager {
    protected $_dataBase;

    protected function __construct($dbName, $dbUser = 'root', $dbPass = '', $charset = 'utf8') {
        //Connexion à la base de données
        $errMsg = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        $this->_dataBase = new PDO("mysql:host=localhost;dbname=$dbName;charset=$charset", $dbUser, $dbPass, $errMsg);
        
        //En cas d'échec de connexion
        if (!$this->_dataBase) throw new Exception("Base De Données : Echec de connexion");
    }
    
    protected function __destruct() {
        $this->_dataBase = null;
    }
}
