<?php
require_once(__DIR__."/../abstract/Manager.php");
require_once(__DIR__."/../entity/Activity.php");

class ActivityManager extends Manager {

    public function getAllByIdActivity($idactivity){ 
        $query = 'SELECT * FROM Activity ORDER BY ID_activity';

        $request = parent::getDBConnect()->prepare($query);
        if (!request->execute($idactivity)) throw new Exception("Base De Donnéez : Echec d'exécution");

        foreach ($request->fetchAll(PDO::FETCH_COLUMN) as $line){
            $result[] = new Activity($line);
        }
        
        return $result;
    }
}

