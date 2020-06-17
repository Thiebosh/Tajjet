<?php
require_once(__DIR__."/../abstract/Manager.php");
require_once(__DIR__."/../entity/Sport.php");

class SportManager extends Manager {
    
    public function getAllByIdSport($idSport){

        $query = 'SELECT * FROM sport ORDER BY ID_sport';

        $request = parent::getDBConnect()->prepare($query);
        if (!request->execute(array($idSport))) throw new Exception("Base De Donnéez : Echec d'exécution");
        
        foreach($request->fetchALL(PDO::FETCH_COLUMN) as $line){
            $result[] = new Sport($line);
        }

        return $result;
    }
    
}

