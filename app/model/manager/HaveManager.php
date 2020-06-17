<?php
require_once(__DIR__."/../abstract/Manager.php");
require_once(__DIR__."/../entity/Have.php");

class HaveManager extends Manager {
    //constructor & destructor
    /*public function __construct($dbName, $dbUser = 'root', $dbPass = '', $charset = 'utf8') {
        parent::__construct($dbName, $dbUser, $dbPass, $charset);
    }*/
    public function __construct() {
    }
    
    public function __destruct() {
        parent::__destruct();
    }

    public function getAllByIdUser($idUser){ //Pour afficher la liste de ce que l'utilisateur possède selon son id (de quel utilisateur il s'agit)
        
        return array( new Have() );
    }

    public function addItemAndQuantityByIdUser($idUser){ //Lorsque l'utilisateur entrera ce dont il doit acheter pour certaines recettes, s'il en reste et que ce n'était pas enregistré au préalable
        
    }

    public function updateItemAndQuantityByIdUser($idUser){ //Lorsque l'utilisateur entrera ce dont il doit acheter pour certaines recettes, s'il en reste et que c'était enregistré au préalable
        
        
    }
    
}