<?php
require_once(__DIR__."/../abstract/Manager.php");
require_once(__DIR__."/../entity/Sport.php");

class SportManager extends Manager {//pattern CRUD : create, read, update, delete + methodes pratiques
    private function getMuscles($idSport) {
        $query = 'SELECT ID_muscle FROM Work WHERE ID_sport = :id';
        $table = array("id" => $idSport);

        $request = parent::prepareAndExecute($query, $table);

        $list = array();
        //muscles id for sport
        foreach ($request->fetchAll(PDO::FETCH_COLUMN) as $idMuscle) {
            $query = 'SELECT * FROM Muscle WHERE ID_muscle = :id';
            $table = array("id" => $idMuscle);

            $request = parent::prepareAndExecute($query, $table);
            
            //muscles entity for sport
            foreach ($request->fetchAll(PDO::FETCH_ASSOC) as $muscle) {
                $list[] = new Muscle($muscle);
            }
        }

        return count($list) > 0 ? $list : false;
    }


    public function readRandom() {
        $query = "SELECT * 
                    FROM Sport 
                    ORDER BY RAND()
                    LIMIT 1";

        $request = parent::prepareAndExecute($query);

        $result = $request->fetchAll(PDO::FETCH_ASSOC)[0];

        $result['muscles'] = $this->getMuscles($result['ID_sport']);

        return new Sport($result);
    }


    public function readAll() {
        $query = 'SELECT * FROM Sport';

        $request = parent::prepareAndExecute($query);
        
        //all sport
        foreach ($request->fetchAll(PDO::FETCH_ASSOC) as $line) {
            $line['muscles'] = $this->getMuscles($line['ID_sport']);

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
                $line['muscles'] = $this->getMuscles($line['ID_sport']);

                $result[] = new Sport($line);
            }
        }
        
        return isset($result) ? $result : false;
    }


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

