<?php
require_once(__DIR__."/../abstract/Manager.php");
require_once(__DIR__."/../entity/Category.php");

class CategoryManager extends Manager {

    public function getAllById($idCategory){
        $query ="SELECT * FROM category ORDER by ID_category ";
        
        $request = parent::getDBConnect()->prepare($query);
        if (!request->execute($idCategory)) throw new Exception("Base De Donnéez : Echec d'exécution");

        foreach ($request->fetchAll(PDO::FETCH_COLUMN) as $line){
           $result[] = new Category($line);
        }

        return $result;
    }
}
