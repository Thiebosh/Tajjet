<?php
require_once(__DIR__."/../abstract/Manager.php");
require_once(__DIR__."/../entity/Sport.php");

class SportManager extends Manager {//pattern CRUD : create, read, update, delete + methodes pratiques
    public function readByName($name) {
        $query = 'SELECT * 
                    FROM Sport 
                    WHERE Label = :label';
        $table = array('label' => $name);

        $request = parent::prepareAndExecute($query, $table);
        
        foreach($request->fetchALL(PDO::FETCH_ASSOC) as $line){
            $result[] = new Sport($line);
        }

        return $result;
    }


    public function readById($id) {
        $query = 'SELECT * 
                    FROM Sport 
                    WHERE ID_sport = :id';
        $table = array('id' => $id);

        $request = parent::prepareAndExecute($query, $table);
        
        $result = $request->fetchAll(PDO::FETCH_ASSOC);
        
        return new Sport($result[0]);
    }
}

