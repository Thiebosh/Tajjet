<?php
require_once(__DIR__."/../abstract/Manager.php");
require_once(__DIR__."/../entity/Article.php");

class ArticleManager extends Manager {
    //requetes sql    
    public function getAllByIdNews($idNews) {
        $query ="SELECT * FROM article ORDER by ID_news ";
        
        $request = parent::getDBConnect()->prepare($query);
        if (!request->execute($idNews)) throw new Exception("Base De Donnéez : Echec d'exécution");

        foreach ($request->fetchAll(PDO::FETCH_COLUMN) as $line){
            $result[] = new Article($line);
        }
        
        return $result;
    }
}

