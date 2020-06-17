<?php
require_once(__DIR__."/../abstract/Manager.php");
require_once(__DIR__."/../entity/Muscle.php");

class MuscleManager extends Manager {
    public function getById($idMuscle){
        $query = "SELECT * FROM muscle WHERE ID_muscle=?";
        $request = parent::getDBConnect()->prepare($query);
        if (!request->execute($idMuscle)) throw new Exception("Base De Donnéez : Echec d'exécution");

        foreach ($request->fetchAll(PDO::FETCH_COLUMN) as $line){
            $result1[] = new Muscle1($line);
        }
    }

        
        return $result1;
}


    public function getAllMuscles(){
        $query = "SELECT * FROM muscle ORDER BY label";
        $request = parent::getDBConnect()->prepare($query);
        if (!request->execute()) throw new Exception("Base De Donnéez : Echec d'exécution");

        foreach ($request->fetchAll(PDO::FETCH_COLUMN) as $line){
           $result[] = new Muscle($line);

        
        return $result;
    }
    
}