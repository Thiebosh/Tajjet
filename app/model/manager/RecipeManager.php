<?php
require_once(__DIR__."/../abstract/Manager.php");
require_once(__DIR__."/../entity/Recipe.php");

class RecipeManager extends Manager {

    public function getByLabel($label){
        
        return new Recipe();
    }
    
}