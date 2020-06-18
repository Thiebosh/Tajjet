<?php
require_once(__DIR__."/../abstract/Manager.php");
require_once(__DIR__."/../entity/Town.php");

class TownManager extends Manager {//pattern CRUD : create, read, update, delete + methodes pratiques
    public function create($label) {
        //1. ajoute ligne
        $query = 'INSERT INTO Town(Label) 
                    VALUES(:label)';
        $table = array('label' => $label);

        $request = parent::getDBConnect()->prepare($query);
        if (!$request->execute($table)) throw new Exception("Base De Donnéez : Echec d'exécution");


        //2. recupere id, meme table
        $query = 'SELECT *
                    FROM Town 
                    WHERE Label = :label';
        
        $request = parent::getDBConnect()->prepare($query);
        if (!$request->execute($table)) throw new Exception("Base De Donnéez : Echec d'exécution");

        $result = $request->fetchAll(PDO::FETCH_ASSOC);
        
        return new Town($result[0]);
    }
    

    public function readById($id) {
        $query = 'SELECT * 
                    FROM Town 
                    WHERE ID_town = :id';
        $table = array('id' => $id);

        $request = parent::getDBConnect()->prepare($query);
        if (!$request->execute($table)) throw new Exception("Base De Donnéez : Echec d'exécution");

        $result = $request->fetchAll(PDO::FETCH_ASSOC);
        
        return new Town($result[0]);
    }


    public function readAll(){
        $query = 'SELECT * 
                    FROM Town 
                    ORDER BY Label';

        $request = parent::getDBConnect()->prepare($query);
        if (!$request->execute()) throw new Exception("Base De Donnéez : Echec d'exécution");

        foreach ($request->fetchAll(PDO::FETCH_COLUMN) as $line){
            $result[] = new Town($line);
        }
        
        return $result;
    }
}
