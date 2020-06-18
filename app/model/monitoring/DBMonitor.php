<?php
require_once(__DIR__."/../abstract/Manager.php");

class DBMonitor extends Manager {
    public function readOutdated() {
        $query = "SELECT re.ModuleName as module, freq.ID_frequency as idFreq
                    FROM Renewal re 
                        INNER JOIN Frequency freq 
                        ON re.ID_frequency = freq.ID_frequency
                    WHERE freq.NextDate <= NOW()";

        $request = parent::prepareAndExecute($query, $table);
        
        return $request->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateOutdated($idFreq) {
        $query = "UPDATE Frequency
                    SET NextDate = DATE_SUB(NOW(), INTERVAL NumberOfDays DAY)
                    WHERE ID_frequency = :id";
        $table = array('id' => $idFreq);
        
        $request = parent::prepareAndExecute($query, $table);
    }
}

