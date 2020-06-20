<?php
require_once(__DIR__."/../abstract/Manager.php");
require_once(__DIR__."/../entity/Town.php");

class TownManager extends Manager {//pattern CRUD : create, read, update, delete + methodes pratiques
    public function create($label) {
        $query = 'INSERT INTO Town(Label) 
                    VALUES(:label)';
        $table = array('label' => $label);

        $request = parent::prepareAndExecute($query, $table);


        //2. recupere id, meme table
        $query = 'SELECT *
                    FROM Town 
                    WHERE Label = :label';
        
        $request = parent::prepareAndExecute($query);

        $result = $request->fetchAll(PDO::FETCH_ASSOC);
        
        echo('here 3 <br>');
        return new Town($result[0]);
    }


    public function searchByName($name) {
        echo('coucou');
        $query = 'SELECT *
                    FROM Town 
                    WHERE LOWER(Label) LIKE LOWER(:label)';
        $table = array('label' => '%'.$name.'%');

        $request = parent::prepareAndExecute($query, $table);

        $result = $request->fetchAll(PDO::FETCH_ASSOC);//fetchAll => close cursor implicite

        return (count($result) != 0) ? new Town($result[0]) : false;//fetchAll => tableau => indice 0
    }
    

    public function readById($id) {
        echo('coucou1');
        $query = 'SELECT * 
                    FROM Town 
                    WHERE ID_town = :id';
        $table = array('id' => $id);

        $request = parent::prepareAndExecute($query, $table);

        $result = $request->fetchAll(PDO::FETCH_ASSOC);
        
        return new Town($result[0]);
    }


    public function readByName($name) {
        echo('coucou2');
        $query = 'SELECT *
                    FROM Town 
                    WHERE LOWER(Label) = LOWER(:label)';
        $table = array('label' => $name);

        $request = parent::prepareAndExecute($query, $table);

        $result = $request->fetchAll(PDO::FETCH_ASSOC);//fetchAll => close cursor implicite

        return (count($result) != 0) ? new Town($result[0]) : false;//fetchAll => tableau => indice 0
    }


    public function readAll() {
        echo('coucou3');
        $query = 'SELECT * 
                    FROM Town 
                    ORDER BY Label';

        $request = parent::prepareAndExecute($query);

        foreach ($request->fetchAll(PDO::FETCH_ASSOC) as $line){
            $result[] = new Town($line);
        }
        
        return isset($result) ? $result : false;
    }
}
