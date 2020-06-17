<?php
require_once(__DIR__."/../abstract/Manager.php");
require_once(__DIR__."/../entity/Muscle.php");

class MuscleManager extends Manager {
    public function getById($idMuscle){
        $query = "SELECT * FROM Muscle WHERE ID_muscle=?"
        $request = parent::getDBConnect()->prepare($query);
        if (!request->execute($idMuscle)) throw new Exception("Base De Donnéez : Echec d'exécution");

        foreach ($request->fetchAll(PDO::FETCH_COLUMN)
    }

        
        return new Muscle();
}


    public function getAllMuscles(){
        $query = "SELECT * FROM Muscle ORDER BY label"
        $request = parent::getDBConnect()->prepare($query);
        if (!request->execute()) throw new Exception("Base De Donnéez : Echec d'exécution");

        foreach ($request->fetchAll(PDO::FETCH_COLUMN) as line){
           $result[] = new Muscle($line);

        
        return array( new Muscle() );
    }
    
}