<?php
require_once(__DIR__."/../abstract/Manager.php");

class ArticleManager extends Manager {
    //constructor & destructor
    public function __construct($dbName, $dbUser = 'root', $dbPass = '', $charset = 'utf8') {
        parent::__construct($dbName, $dbUser, $dbPass, $charset);
    }

    public function __destruct() {
        parent::__destruct();
    }


    //requetes sql    
    public function getByArticle($idArticle) {

    }
    
}