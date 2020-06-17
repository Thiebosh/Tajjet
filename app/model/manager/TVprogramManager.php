<?php
require_once(__DIR__."/../abstract/Manager.php");
require_once(__DIR__."/../entity/TVprogram.php");

class TVprogramManager extends Manager {

    public function getAllAfterTime($time){
        $query = "SELECT * FROM TVprogam ORDER BY ID_TVprogam";
        $request = parent::getDBConnect()->prepare($query);
        if (!request->execute(array($townLabel))) throw new Exception("Base De Donnéez : Echec d'exécution");

        foreach ($request->fetchAll(PDO::FETCH_COLUMN) as $line){
            $result[] = new TVprogram($line);
        }

        return $result;
    }
        
    
    
}
