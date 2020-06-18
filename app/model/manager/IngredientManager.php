<?php
require_once(__DIR__."/../abstract/Manager.php");
require_once(__DIR__."/../entity/Ingredient.php");

class IngredientManager extends Manager {//pattern CRUD : create, read, update, delete + methodes pratiques
    public function getById($id){
        $query = "SELECT * 
                    FROM Ingredient 
                    WHERE ID_ingredient = :id";
        $table = array('id' => $id);

        $request = parent::getDBConnect()->prepare($query);
        if (!$request->execute($table)) throw new Exception("Base De Donnéez : Echec d'exécution");

        $result = $request->fetchAll(PDO::FETCH_ASSOC);
        
        return new Ingredient($result[0]);
    }

    //si ingredients par recette, inner join
}