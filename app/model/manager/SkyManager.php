<?php
require_once(__DIR__."/../abstract/Manager.php");
require_once(__DIR__."/../entity/Sky.php");

class SkyManager extends Manager {
    public function getById($idSky){
        $query = "SELECT * FROM Sky WHERE ID_sky =?"

        $request = parent::getDBConnect()->prepare($query);
        if (!request->execute(array($idsky))) throw new Exception("Base De Donnéez : Echec d'exécution");

        foreach ($request->fetchAll(PDO::FETCH_COLUMN)
        }

        return new Sky();
    }
    
}
