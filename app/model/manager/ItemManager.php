<?php
require_once(__DIR__."/../abstract/Manager.php");
require_once(__DIR__."/../entity/Item.php");

class ItemManager extends Manager {
    //constructor & destructor
    /*public function __construct($dbName, $dbUser = 'root', $dbPass = '', $charset = 'utf8') {
        parent::__construct($dbName, $dbUser, $dbPass, $charset);
    }*/
    public function __construct() {
    }

    public function __destruct() {
        parent::__destruct();
    }

    public function getAllByRecipie($idRecipie){

        return array( new Item() );
    }

}