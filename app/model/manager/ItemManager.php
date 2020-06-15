<?php
require_once(__DIR__."/../abstract/Manager.php");
require_once(__DIR__."/../entity/Item.php");

class HealthManager extends Manager {
    //constructor & destructor
    public function __construct($dbName, $dbUser = 'root', $dbPass = '', $charset = 'utf8') {
        parent::__construct($dbName, $dbUser, $dbPass, $charset);
    }

    public function __destruct() {
        parent::__destruct();
    }

    public function getLabelById($idItem){
        //$label=
        return new Item();
    }
    public function getQuantityByIdItemAndRecipe($idItem,$idRecipe){
        //$quantity
        return new Item();
    }
}