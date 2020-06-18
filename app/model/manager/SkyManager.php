<?php
require_once(__DIR__."/../abstract/Manager.php");
require_once(__DIR__."/../entity/Sky.php");

class SkyManager extends Manager {//pattern CRUD : create, read, update, delete + methodes pratiques
    public function readById($idSky) {
        $query = "SELECT * 
                    FROM Sky 
                    WHERE ID_sky = :id";
        $table = array('id' => $idSky);

        $request = parent::prepareAndExecute($query, $table);

        $result = $request->fetchAll(PDO::FETCH_ASSOC);
        
        return new Sky($result[0]);
    }
}
