<?php
require_once(__DIR__."/../abstract/Manager.php");
require_once(__DIR__."/../entity/Recipe.php");

class RecipeManager extends Manager {//pattern CRUD : create, read, update, delete + methodes pratiques
    public function readByID($id) {
        $query = 'SELECT * 
                    FROM Recipe 
                    WHERE ID_recipe = :id';
        $table = array('id' => $id);

        $request = parent::getDBConnect()->prepare($query);
        if (!$request->execute($table)) throw new Exception("Base De Donnéez : Echec d'exécution");
        
        $result = $request->fetchAll(PDO::FETCH_ASSOC);
        
        return new Recipe($result[0]);
    }


    public function readByName($name) {//full name
        $query = 'SELECT * 
                    FROM Recipe 
                    WHERE Name = :name';
        $table = array('name' => $name);

        $request = parent::getDBConnect()->prepare($query);
        if (!$request->execute($table)) throw new Exception("Base De Donnéez : Echec d'exécution");
        
        $result = $request->fetchAll(PDO::FETCH_ASSOC);
        
        return (count($result) != 0) ? new Recipe($result[0]) : false;
    }


    public function searchByName($name) {//approx name
        $query = 'SELECT * 
                    FROM Recipe 
                    WHERE LOWER(Name) LIKE LOWER(:search)
                    ORDER BY Name';
        $table = array('search' => $name);

        $request = parent::getDBConnect()->prepare($query);
        if (!$request->execute($table)) throw new Exception("Base De Donnéez : Echec d'exécution");
        
        foreach($request->fetchALL(PDO::FETCH_COLUMN) as $line){
            $result[] = new Recipe($line);
        }

        return $result;
    }
}