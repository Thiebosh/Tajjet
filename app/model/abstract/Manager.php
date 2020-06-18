<?php

abstract class Manager {
    private static $dbName;
    private static $dbUser;
    private static $dbPass;
    private static $charset;

    public static function setDBData($dbName, $dbUser = 'root', $dbPass = '', $charset = 'utf8') {
        self::$dbName = $dbName;
        self::$dbUser = $dbUser;
        self::$dbPass = $dbPass;
        self::$charset = $charset;
    }

    protected function getDBConnect() {
        $errMsg = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        $db = new PDO('mysql:host=localhost;dbname='.self::$dbName.';charset='.self::$charset, self::$dbUser, self::$dbPass, $errMsg);
        
        if (!$db) throw new Exception("Base De Données : Echec de connexion");

        return $db;
    }

    protected function prepareAndExecute($query, $table = "") {
        $request = $this->getDBConnect()->prepare($query);
        if (!$request->execute($table)) throw new Exception("Base De Données : Echec d'exécution");
        return $request;
    }
}
