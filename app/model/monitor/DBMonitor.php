<?php
require_once(__DIR__."/../abstract/Manager.php");

class DBMonitor extends Manager {
    public function readOutdatedModulesNames() {
        $query = "SELECT re.ModuleName as module, freq.ID_frequency as idFreq
                    FROM Renewal re 
                        INNER JOIN Frequency freq 
                        ON re.ID_frequency = freq.ID_frequency
                    WHERE freq.NextDate <= NOW()";

        $request = parent::prepareAndExecute($query);
        
        return $request->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateOutdatedFrequency($idFreq) {//juste date du jour - DAY_HOUR => 12h = 0.12, 48h = 2.0 = 0.48
        $query = "UPDATE Frequency
                    SET NextDate = DATE_ADD(DATE(NOW()), INTERVAL 
                            CASE WHEN NumberOfDays = FLOOR(NumberOfDays) 
                                THEN CONCAT(NumberOfDays, '.0')
                                ELSE ROUND(NumberOfDays * CASE WHEN HOUR(NOW()) < 10 * NumberOfDays THEN 1 ELSE 2 END, 2)
                            END
                        DAY_HOUR)                 
                    WHERE ID_frequency = :id";
        $table = array('id' => $idFreq);
        
        parent::prepareAndExecute($query, $table);
    }
}

