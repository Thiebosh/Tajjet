<?php
require_once(__DIR__."/../abstract/Manager.php");
require_once(__DIR__."/../entity/Town.php");

class TownManager extends Manager {
    public function getAllTownLabel(){
        $query = 'SELECT * FROM town ORDER BY ID_town';

        $request = parent::getDBConnect()->prepare($query);
        if (!request->execute()) throw new Exception("Base De Donnéez : Echec d'exécution");

        foreach ($request->fetchAll(PDO::FETCH_COLUMN) as $line){
            $result[] = new Town($line);
        }

        
        return $result;
    }

    public function addTown($labelTown){
        $query = 'INSERT INTO town Values (:Label)';


        $request = parent::getDBConnect()->prepare($query);
        if (!request->execute()) throw new Exception("Base De Donnéez : Echec d'exécution");

        foreach ($request->fetchAll(PDO::FETCH_COLUMN) as $line){
            $result1[] = new NewlabelTown($line);
        }

        return $result1;
    }
    
    public function getIdTown($townLabel) {

    $query = 'SELECT * FROM town WHERE ID_town=?';

    $request = parent::getDBConnect()->prepare($query);
        if (!request->execute(array($townLabel))) throw new Exception("Base De Donnéez : Echec d'exécution");

        foreach ($request->fetchAll(PDO::FETCH_COLUMN) as $line){
            $result2[] = new IdTown($line);
        }
        return $result2;
    }
        

}
