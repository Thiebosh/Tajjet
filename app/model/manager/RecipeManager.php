<?php
require_once(__DIR__."/../abstract/Manager.php");
require_once(__DIR__."/../entity/Recipe.php");

class RecipeManager extends Manager {

    public function getByID($ID_recipe){
        
        $query = 'SELECT * FROM recipe ORDER BY ID_recipe';

        $request = parent::getDBConnect()->prepare($query);
        if (!$request->execute(array($idRecipe))) throw new Exception("Base De Donnéez : Echec d'exécution");
        
        foreach($request->fetchALL(PDO::FETCH_COLUMN) as $line){
            $result[] = new Recipe($line);
        }

        return $result;
    }
    
}