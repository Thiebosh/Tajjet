<?php
require_once(__DIR__."/../abstract/Manager.php");
require_once(__DIR__."/../entity/Item.php");

class ItemManager extends Manager {
	
    public function getAllByRecipe($idRecipe){

        $query = "SELECT * FROM recipe ORDER BY ID_recipe";
        $request = parent::getDBConnect()->prepare($query);
        if (!request->execute($idRecipe)) throw new Exception("Base De Donnéez : Echec d'exécution");

        foreach ($request->fetchAll(PDO::FETCH_COLUMN) as $line){
           $result[] = new Item($line);

        return $result;
    }

}