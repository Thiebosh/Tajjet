<?php
require_once(__DIR__."/../abstract/Manager.php");
require_once(__DIR__."/../entity/Health.php");

class HealthManager extends Manager {//pattern CRUD : create, read, update, delete + methodes pratiques
    public function createTodayRecord($health) {
        $query = 'INSERT INTO Health(RecordDate, Weight, Calories, Sleep, ID_user)
                    VALUES(NOW(), :weight, :calories, :sleep, :id)';
        $table = array('id'         => $health->getIdUser(),
                        'calories'  => ($health->getCalories()  != null) ? $health->getCalories()                   : PDO::PARAM_NULL,
                        'sleep'     => ($health->getSleep()     != null) ? Entity::printDate($health->getSleep())   : PDO::PARAM_NULL,
                        'weight'    => ($health->getWeight()    != null) ? $health->getWeight()                     : PDO::PARAM_NULL);

        $request = parent::getDBConnect()->prepare($query);
        if (!$request->execute($table)) throw new Exception("Base De Données : Echec d'exécution");


        $query = 'SELECT *
                    FROM Health 
                    WHERE RecordDate = NOW()';
        
        $request = parent::getDBConnect()->prepare($query);
        if (!$request->execute()) throw new Exception("Base De Données : Echec d'exécution");

        $result = $request->fetchAll(PDO::FETCH_ASSOC);//fetchAll => close cursor implicite

        return new Health($result[0]);//gagne un id
    }


    public function readTodayRecord() {
        $query = "SELECT * 
                    FROM Health 
                    WHERE RecordDate = NOW()";

        $request = parent::getDBConnect()->prepare($query);
        if (!request->execute() throw new Exception("Base De Donnéez : Echec d'exécution");

        $result = $request->fetchAll(PDO::FETCH_ASSOC);//fetchAll => close cursor implicite

        return (count($result) != 0) ? new Health($result[0]) : false;
    }


    public function readLast7Days($idUser) {
        $query = "SELECT * 
                    FROM Health 
                    WHERE ID_user = :id
                    AND RecordDate > DATE_SUB(NOW(), INTERVAL 7 DAY)";
        $table = array('id' => $idUser);

        $request = parent::getDBConnect()->prepare($query);
        if (!request->execute($table) throw new Exception("Base De Donnéez : Echec d'exécution");

        foreach ($request->fetchAll(PDO::FETCH_COLUMN) as $line){
            $result[] = new Health($line);
        }

        return $result;
    }


    public function updateTodayRecord($health) {
        if ($health->getId() == null) return $this->createTodayRecord($health);
        
        $query = 'UPDATE Health
                    SET Weight = :weight, 
                        Calories = :calories, 
                        Sleep = :sleep
                    WHERE ID_user = :id
                    AND RecordDate = NOW()';
        $table = array('id'         => $health->getIdUser(),
                        'calories'  => ($health->getCalories()  != null) ? $health->getCalories()                   : PDO::PARAM_NULL,
                        'sleep'     => ($health->getSleep()     != null) ? Entity::printDate($health->getSleep())   : PDO::PARAM_NULL,
                        'weight'    => ($health->getWeight()    != null) ? $health->getWeight()                     : PDO::PARAM_NULL);

        $request = parent::getDBConnect()->prepare($query);
        if (!$request->execute($table)) throw new Exception("Base De Données : Echec d'exécution");

        return $health;
    }
}   