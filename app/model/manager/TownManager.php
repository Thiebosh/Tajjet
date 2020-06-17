<?php
require_once(__DIR__."/../abstract/Manager.php");
require_once(__DIR__."/../entity/Town.php");

class TownManager extends Manager {//pattern CRUD : create, read, update, delete + methodes pratiques
    public function getAllByTownLabel($labelTown){
        
        return array( new Town() );
    }

    public function addTown($labelTown){
        
    }
    
    public function readById($townLabel) {

        return 2;
    }
    
    public function readByName($townLabel) {

        return 2;
    }
}