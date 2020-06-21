<?php
require_once(__DIR__."/../abstract/Manager.php");
require_once(__DIR__."/../entity/Article.php");

class ArticleManager extends Manager {
    public function readAll() {
        $query ="SELECT * FROM Article";
        
        $request = parent::prepareAndExecute($query);

        foreach ($request->fetchAll(PDO::FETCH_ASSOC) as $line){
            $result[] = new Article($line);
        }
        
        return $result;
    }

    public function readRandom() {
        $query = "SELECT * 
                    FROM Article 
                    ORDER BY RAND()
                    LIMIT 1";

        $request = parent::prepareAndExecute($query);

        return new Article($request->fetchAll(PDO::FETCH_ASSOC)[0]);
    }
}

