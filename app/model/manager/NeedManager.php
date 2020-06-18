<?php
require_once(__DIR__."/../abstract/Manager.php");
require_once(__DIR__."/../entity/Need.php");

class NeedManager extends Manager {//pas sur que existe
    public function getQuantityByIdItemAndRecipe($idItem,$idRecipe){
       $query = "SELECT * FROM Need";

       $request = parent::prepareAndExecute($query);

        foreach ($request->fetchAll(PDO::FETCH_COLUMN) as $line){
           $result[] = new Need($line);
       }
        return $result;
    }
}