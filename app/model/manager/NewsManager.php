<?php
require_once(__DIR__."/../abstract/Manager.php");
require_once(__DIR__."/../entity/News.php");

class NewsManager extends Manager {
    //constructor & destructor
    /*public function __construct($dbName, $dbUser = 'root', $dbPass = '', $charset = 'utf8') {
        parent::__construct($dbName, $dbUser, $dbPass, $charset);
    }*/
    public function __construct() {
    }

    public function __destruct() {
        parent::__destruct();
    }

    public function getAllByIdNews($idNews){ //Pour tout récupérer selon si l'utilisateur a choisi "actu" ou "résultats sportifs", donc à partir de l'id News
        $bdd = dbConnect();

        $query = 'SELECT * FROM news ORDER BY ID_news'
        $request = $bdd->prepare($query);
        if (!request->execute()){
            throw new Exception("Base De Donnéez : Echec d'exécution");
        }

        foreach ($request->fetchAll(PDO::FETCH_COLUMN) as $line){
            $News[] = $line;
        }
        return $News;
    }
    
}