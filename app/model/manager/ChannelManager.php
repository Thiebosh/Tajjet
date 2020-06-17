<?php
require_once(__DIR__."/../abstract/Manager.php");
require_once(__DIR__."/../entity/Channel.php");

class ChannelManager extends Manager {

    public function getAllById($idChannel){
        $query = "SELECT * FROM Channel ORDER BY ID_Channel";
        $request = parent::getDBConnect()->prepare($query);
        if (!request->execute($idChannel)) throw new Exception("Base De Donnéez : Echec d'exécution");

        foreach ($request->fetchAll(PDO::FETCH_COLUMN) as $line){
           $result[] = new Channel($line);
       }
        return array( new Channel() );
    }
    
}

