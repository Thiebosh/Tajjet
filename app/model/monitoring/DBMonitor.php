<?php
require_once(__DIR__."/../abstract/Manager.php");
require_once(__DIR__."/../entity/Renewal.php");

class DBMonitor extends Manager {
    public function readOutdated() {
        $query = "SELECT re.ModuleName as module
                    FROM Renewal re 
                        INNER JOIN Frequency freq 
                        ON re.ID_frequency = freq.ID_frequency
                    WHERE freq.NextDate <= NOW()";

        $request = parent::getDBConnect()->prepare($query);
        if (!$request->execute()) throw new Exception("Base De Donnéez : Echec d'exécution");
        
        return $request->fetchAll(PDO::FETCH_ASSOC);
    }
}

