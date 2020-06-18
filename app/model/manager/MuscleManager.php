<?php
require_once(__DIR__."/../abstract/Manager.php");
require_once(__DIR__."/../entity/Muscle.php");

class MuscleManager extends Manager {//pattern CRUD : create, read, update, delete + methodes pratiques
    public function readById($idMuscle) {
        $query = "SELECT * 
                    FROM Muscle 
                    WHERE ID_muscle = :id";
        $table = array('id' => $idMuscle);

        $request = parent::getDBConnect()->prepare($query);
        if (!request->execute($table)) throw new Exception("Base De Donnéez : Echec d'exécution");

        $result = $request->fetchAll(PDO::FETCH_ASSOC);
        
        return new Muscle($result[0]);
    }


    public function readAll() {
        $query = "SELECT * 
                    FROM Muscle 
                    ORDER BY Label";

        $request = parent::getDBConnect()->prepare($query);
        if (!request->execute()) throw new Exception("Base De Donnéez : Echec d'exécution");

        foreach ($request->fetchAll(PDO::FETCH_COLUMN) as $line){
            $result[] = new Muscle($line);
        }
        
        return $result;
    }
}