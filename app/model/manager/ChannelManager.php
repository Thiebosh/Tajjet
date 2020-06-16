<?php
require_once(__DIR__."/../abstract/Manager.php");
require_once(__DIR__."/../entity/Channel.php");

class ChannelManager extends Manager {
    //constructor & destructor
    /*public function __construct($dbName, $dbUser = 'root', $dbPass = '', $charset = 'utf8') {
        parent::__construct($dbName, $dbUser, $dbPass, $charset);
    }*/
    public function __construct() {
    }

    public function __destruct() {
        parent::__destruct();
    }

    public function getAllById($idChannel){
        
        return array( new Channel() );
    }
    
}