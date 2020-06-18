<?php
require_once(__DIR__."/../abstract/Manager.php");
require_once(__DIR__."/../entity/Sport.php");

class SportManager extends Manager {//pattern CRUD : create, read, update, delete + methodes pratiques
    public function readByName($name) {
        $query = 'SELECT * 
                    FROM Sport 
                    WHERE Label = :label';
        $table = array('label' => $name);

        $request = parent::getDBConnect()->prepare($query);
        if (!$request->execute($table)) throw new Exception("Base De Donnéez : Echec d'exécution");
        
        foreach($request->fetchALL(PDO::FETCH_COLUMN) as $line){
            $result[] = new Sport($line);
        }

        return $result;
    }


    public function readById($id) {
        $query = 'SELECT * 
                    FROM Sport 
                    WHERE ID_sport = :id';
        $table = array('id' => $id);

        $request = parent::getDBConnect()->prepare($query);
        if (!$request->execute($table)) throw new Exception("Base De Donnéez : Echec d'exécution");
        
        $result = $request->fetchAll(PDO::FETCH_ASSOC);
        
        return new Sport($result[0]);
    }
}

