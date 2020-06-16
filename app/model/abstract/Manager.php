<?php

abstract class Manager {
    protected static $_dataBase;

    public static function dbConnect($dbName, $dbUser = 'root', $dbPass = '', $charset = 'utf8') {
        //Connexion à la base de données
        $errMsg = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        self::$_dataBase = new PDO("mysql:host=localhost;dbname=$dbName;charset=$charset", $dbUser, $dbPass, $errMsg);
        
        //En cas d'échec de connexion
        if (!self::$_dataBase) throw new Exception("Base De Données : Echec de connexion");
    }

    protected function __destruct() {
        self::$_dataBase = null;
    }
}
