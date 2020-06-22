<?php
require_once(__DIR__."/../abstract/Manager.php");
require_once(__DIR__."/../entity/Muscle.php");

class MuscleManager extends Manager {//pattern CRUD : create, read, update, delete + methodes pratiques
    public function readById($idMuscle) {
        $query = "SELECT * 
                    FROM Muscle 
                    WHERE ID_muscle = :id";
        $table = array('id' => $idMuscle);

        $request = parent::prepareAndExecute($query, $table);
        
        return new Muscle($request->fetchAll(PDO::FETCH_ASSOC)[0]);
    }

    public function readByName($name) {
        $query = "SELECT * 
                    FROM Muscle 
                    WHERE Label = :label";
        $table = array('label' => $name);

        $request = parent::prepareAndExecute($query, $table);
        
        return new Muscle($request->fetchAll(PDO::FETCH_ASSOC)[0]);
    }

    public function readAll() {
        $query = "SELECT * 
                    FROM Muscle 
                    ORDER BY Label";

        $request = parent::prepareAndExecute($query);

        foreach ($request->fetchAll(PDO::FETCH_ASSOC) as $line){
            $result[] = new Muscle($line);
        }
        
        return $result;
    }
}