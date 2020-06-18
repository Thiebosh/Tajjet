<?php
require_once(__DIR__."/../abstract/Manager.php");
require_once(__DIR__."/../entity/Type.php");

class TypeManager extends Manager {//pattern CRUD : create, read, update, delete + methodes pratiques
    public function readById($id) {
        $query = "SELECT * 
                    FROM Type 
                    WHERE ID_type = :id";
        $table = array('id' => $id);

        $request = parent::getDBConnect()->prepare($query);
        if (!request->execute($table)) throw new Exception("Base De Donnéez : Echec d'exécution");

        $result = $request->fetchAll(PDO::FETCH_ASSOC);
        
        return new Type($result[0]);
    }


    public function readAll() {
        $query = "SELECT * 
                    FROM Type 
                    ORDER BY Label";

        $request = parent::getDBConnect()->prepare($query);
        if (!request->execute()) throw new Exception("Base De Donnéez : Echec d'exécution");

        foreach ($request->fetchAll(PDO::FETCH_COLUMN) as $line){
            $result[] = new Type($line);
        }
        
        return $result;
    }
}