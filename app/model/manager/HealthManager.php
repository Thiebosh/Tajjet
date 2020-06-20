<?php
require_once(__DIR__."/../abstract/Manager.php");
require_once(__DIR__."/../entity/Health.php");

class HealthManager extends Manager {//pattern CRUD : create, read, update, delete + methodes pratiques
    public function createTodayRecord($health) {
        $query = 'INSERT INTO Health(RecordDate, Weight, Calories, Sleep, ID_user)
                    VALUES(NOW(), :weight, :calories, :sleep, :id)';
        $table = array('id'         => $health->getIdUser(),
                        'calories'  => ($health->getCalories()  != null) ? $health->getCalories()   : PDO::PARAM_NULL,
                        'sleep'     => ($health->getSleep()     != null) ? $health->getSleep()      : PDO::PARAM_NULL,
                        'weight'    => ($health->getWeight()    != null) ? $health->getWeight()     : PDO::PARAM_NULL);

        $request = parent::prepareAndExecute($query, $table);


        $query = 'SELECT *
                    FROM Health 
                    WHERE RecordDate = NOW()';
        
        $request = parent::prepareAndExecute($query);

        $result = $request->fetchAll(PDO::FETCH_ASSOC);//fetchAll => close cursor implicite

        return new Health($result[0]);//gagne un id
    }


    public function readTodayRecord($userId) {
        $query = "SELECT * 
                    FROM Health 
                    WHERE RecordDate = NOW()
                    AND ID_user = :id";
        $table = array('id' => $userId);

        $request = parent::prepareAndExecute($query, $table);

        $result = $request->fetchAll(PDO::FETCH_ASSOC);//fetchAll => close cursor implicite

        return (count($result) != 0) ? new Health($result[0]) : false;
    }


    public function readLast7Days($idUser) {
        $query = "SELECT * 
                    FROM Health 
                    WHERE ID_user = :id
                    AND RecordDate > DATE_SUB(NOW(), INTERVAL 7 DAY)
                    ORDER BY RecordDate";
        $table = array('id' => $idUser);

        $request = parent::prepareAndExecute($query, $table);

        $result = array();
        foreach ($request->fetchAll(PDO::FETCH_ASSOC) as $line){
            $result[] = new Health($line);
        }

        return (count($result) != 0) ? $result : false;
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
                        'calories'  => ($health->getCalories()  != null) ? $health->getCalories()   : PDO::PARAM_NULL,
                        'sleep'     => ($health->getSleep()     != null) ? $health->getSleep()      : PDO::PARAM_NULL,
                        'weight'    => ($health->getWeight()    != null) ? $health->getWeight()     : PDO::PARAM_NULL);

        $request = parent::prepareAndExecute($query, $table);

        return $health;
    }
}   