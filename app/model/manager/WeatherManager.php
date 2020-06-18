<?php
require_once(__DIR__."/../abstract/Manager.php");
require_once(__DIR__."/../entity/Weather.php");

class WeatherManager extends Manager {
    public function readByIdTown($idTown){
        $query = 'SELECT * 
                    FROM Weather 
                    WHERE ID_town = :id';
        $table = array('id' => $idTown);

        $request = parent::getDBConnect()->prepare($query);
        if (!request->execute($table)) throw new Exception("Base De Donnéez : Echec d'exécution");
        
        foreach ($request->fetchAll(PDO::FETCH_COLUMN) as $line){
            $result[] = new Weather($line);
        }
        
        return $result;
    }
}