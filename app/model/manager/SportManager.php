<?php
require_once(__DIR__."/../abstract/Manager.php");
require_once(__DIR__."/../entity/Sport.php");
require_once("MuscleManager.php");

class SportManager extends Manager {//pattern CRUD : create, read, update, delete + methodes pratiques
    private function getMuscles($idSport) {
        $query = 'SELECT ID_muscle FROM Work WHERE ID_sport = :id';
        $table = array("id" => $idSport);

        $request = parent::prepareAndExecute($query, $table);

        $list = array();
        //muscles id for sport
        foreach ($request->fetchAll(PDO::FETCH_COLUMN) as $idMuscle) {
            $list[] = (new MuscleManager)->readById($idMuscle);
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


    public function readById($id) {
        $query = 'SELECT * 
                    FROM Sport 
                    WHERE ID_sport = :id';
        $table = array('id' => $id);

        $request = parent::prepareAndExecute($query, $table);
        
        $result = $request->fetchAll(PDO::FETCH_ASSOC)[0];
        $result['muscles'] = $this->getMuscles($result['ID_sport']);
        
        return new Sport($result);
    }


    public function readByMuscle($muscle) {
        if($muscle == 'Default') return $this->readAll();

        $query = 'SELECT ID_sport FROM Work WHERE ID_muscle = :id';
        $table = array("id" => (new MuscleManager)->readByName($muscle)->getId());

        $request = parent::prepareAndExecute($query, $table);
        
        //all sport
        foreach ($request->fetchAll(PDO::FETCH_COLUMN) as $idSport) {
            $result[] = $this->readById($idSport);
        }
        
        return $result;
    }


    public function searchByName($name) {
        $query = 'SELECT * 
                    FROM Sport 
                    WHERE LOWER(Label) LIKE LOWER(:label)';
        $table = array('label' => '%'.$name.'%');

        $request = parent::prepareAndExecute($query, $table);
        
        $request = $request->fetchAll(PDO::FETCH_ASSOC);
        
        if (count($request) > 0) {
            foreach ($request as $line) {
                $line['muscles'] = $this->getMuscles($line['ID_sport']);

                $result[] = new Sport($line);
            }

            return $result;
        }
        
        return false;
    }


    public function searchByNameAndMuscle($muscle, $name) {
        $query = 'SELECT ID_sport FROM Work';

        if ($name != "Default") {
            $query .= ' WHERE ID_muscle = :id';
            $table = array("id" => (new MuscleManager)->readByName($muscle)->getId());

            $request = parent::prepareAndExecute($query, $table);
        }
        else $request = parent::prepareAndExecute($query);
        
        //all sport
        foreach ($request->fetchAll(PDO::FETCH_COLUMN) as $idSport) {
            $tmp = $this->readByIdAndName($idSport, $name);
            if ($tmp != false) $result[] = $tmp;
        }
        
        return $result;
    }


    public function readByIdAndName($id, $name) {
        $query = 'SELECT * 
                    FROM Sport 
                    WHERE ID_sport = :id
                    AND LOWER(Label) LIKE LOWER(:label)';
        $table = array('id' => $id, 'label' => '%'.$name.'%');

        $request = parent::prepareAndExecute($query, $table);
        
        $result = $request->fetchAll(PDO::FETCH_ASSOC);
        if (count($result) > 0) {
            $result = $result[0];
            $result['muscles'] = $this->getMuscles($result['ID_sport']);

            return new Sport($result);
        }
        
        return false;
    }

    public function resetProgram($idUser) {
        $query = 'DELETE FROM Program
                    WHERE ID_user = :id';
        $table = array('id' => $idUser);

        $request = parent::prepareAndExecute($query, $table);
    }

    public function addToProgram($idUser, $idExo) {
        $query = 'INSERT INTO Program(ID_user, ID_sport)
                    VALUES(:user, :sport)';
        $table = array('user' => $idUser, 'sport' => $idExo);

        $request = parent::prepareAndExecute($query, $table);
    }
}

