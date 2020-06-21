<?php
require_once(__DIR__."/../abstract/Manager.php");
require_once(__DIR__."/../entity/Recipe.php");

class RecipeManager extends Manager {//pattern CRUD : create, read, update, delete + methodes pratiques
    public function readByID($id) {
        $query = 'SELECT * 
                    FROM Recipe 
                    WHERE ID_recipe = :id';
        $table = array('id' => $id);

        $request = parent::prepareAndExecute($query, $table);
        
        $result = $request->fetchAll(PDO::FETCH_ASSOC);
        
        return new Recipe($result[0]);
    }


    public function readByName($name, $type) {//full name
        var_dump($name);
        $query = 'SELECT * 
                    FROM Recipe 
                    WHERE Name = :name
                    AND ID_type = :type';
        $table = array('name' => $name, 'type' => $type);

        $request = parent::prepareAndExecute($query, $table);
        
        $result = $request->fetchAll(PDO::FETCH_ASSOC);
        
        return (count($result) != 0) ? new Recipe($result[0]) : false;
    }


    public function readRandom() {
        $query = 'SELECT * 
                    FROM Recipe 
                    ORDER BY RAND()
                    LIMIT 1';

        $request = parent::prepareAndExecute($query);
        
        $result = $request->fetchAll(PDO::FETCH_ASSOC);
        
        return new Recipe($result[0]);
    }


    public function searchByName($name, $type) {//approx name
        $query = 'SELECT * 
                    FROM Recipe 
                    WHERE ID_type = :type
                    AND LOWER(Name) LIKE LOWER(:search)';
        $table = array('search' => '%'.$name.'%', 'type' => $type);

        $request = parent::prepareAndExecute($query, $table);
        
        $result = $request->fetchAll(PDO::FETCH_ASSOC);
        
        return (count($result) != 0) ? new Recipe($result[0]) : false;
    }
}