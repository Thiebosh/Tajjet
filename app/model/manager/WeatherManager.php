<?php
require_once(__DIR__."/../abstract/Manager.php");
require_once(__DIR__."/../entity/Weather.php");
require_once("TownManager.php");
require_once("SkyManager.php");

class WeatherManager extends Manager {
    public function readByIdTown($idTown) {
        $query = 'SELECT * 
                    FROM Weather 
                    WHERE ID_town = :id
                    AND Forecast > NOW()';
        $table = array('id' => $idTown);

        $request = parent::prepareAndExecute($query, $table);
        
        foreach ($request->fetchAll(PDO::FETCH_ASSOC) as $line){
            $line['town'] = (new TownManager)->readById($line['ID_town']);
            $line['sky'] = (new SkyManager)->readById($line['ID_sky']);
            $result[] = new Weather($line);
        }
        
        return $result;
    }

    public function readNowByIdTown($idTown) {
        $query = 'SELECT * 
                    FROM Weather 
                    WHERE ID_town = :id
                    AND Forecast > NOW()
                    ORDER bY Forecast
                    LIMIT 1';
        $table = array('id' => $idTown);

        $request = parent::prepareAndExecute($query, $table);
        
        $line = $request->fetchAll(PDO::FETCH_ASSOC)[0];
        $line['town'] = (new TownManager)->readById($line['ID_town']);
        $line['sky'] = (new SkyManager)->readById($line['ID_sky']);
        
        return new Weather($line);
    }
}