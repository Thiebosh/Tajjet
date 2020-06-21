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


    public function readAll() {
        $query = 'SELECT * FROM Sport';

        $request = parent::prepareAndExecute($query);
        
        //all sport
        foreach ($request->fetchAll(PDO::FETCH_ASSOC) as $line) {
            $query = 'SELECT ID_muscle FROM Work WHERE ID_sport = :id';
            $table = array("id" => $line['ID_sport']);

            $request = parent::prepareAndExecute($query, $table);

            //muscles id for sport
            foreach ($request->fetchAll(PDO::FETCH_COLUMN) as $idMuscle) {
                $query = 'SELECT * FROM Muscle WHERE ID_muscle = :id';
                $table = array("id" => $idMuscle);
    
                $request = parent::prepareAndExecute($query, $table);
                
                //muscles entity for sport
                foreach ($request->fetchAll(PDO::FETCH_ASSOC) as $muscle) {
                    $line['muscles'][] = new Muscle($muscle);
                }
            }

            $result[] = new Sport($line);
        }
        
        return $result;
    }

    
    public function readSeance($idUser) {
        $query = 'SELECT ID_sport FROM Program WHERE ID_user = :id';
        $table = array("id" => $idUser);

        $request = parent::prepareAndExecute($query, $table);

        //sports id for program
        foreach ($request->fetchAll(PDO::FETCH_COLUMN) as $sport) {
            $query = 'SELECT * FROM Sport WHERE ID_Sport = :id';
            $table = array("id" => $sport);

            $request = parent::prepareAndExecute($query, $table);
            
            //all sport
            foreach ($request->fetchAll(PDO::FETCH_ASSOC) as $line) {
                $query = 'SELECT ID_muscle FROM Work WHERE ID_sport = :id';
                $table = array("id" => $line['ID_sport']);

                $request = parent::prepareAndExecute($query, $table);

                //muscles id for sport
                foreach ($request->fetchAll(PDO::FETCH_COLUMN) as $idMuscle) {
                    $query = 'SELECT * FROM Muscle WHERE ID_muscle = :id';
                    $table = array("id" => $idMuscle);
        
                    $request = parent::prepareAndExecute($query, $table);
                    
                    //muscles entity for sport
                    foreach ($request->fetchAll(PDO::FETCH_ASSOC) as $muscle) {
                        $line['muscles'][] = new Muscle($muscle);
                    }
                }

                $result[] = new Sport($line);
            }
        }
        
        return isset($result) ? $result : false;
    }
}

