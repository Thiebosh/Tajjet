<?php
require_once(__DIR__."/../abstract/Manager.php");
require_once(__DIR__."/../entity/Sport.php");

class SportManager extends Manager {
    
    public function getAllByIdMuscle($idMuscle){

        $query = 'SELECT * FROM Town ORDER BY ID_muscle';

        $request = parent::getDBConnect()->prepare($query);
        if (!request->execute(array($idMuscle))) throw new Exception("Base De Donnéez : Echec d'exécution");
        
        foreach($request->fetchALL(PDO::FETCH_COLUMN) as $line){
            $result[] = new Sport($line);
        }

        return $result;
    }
    
}

