<?php
require_once(__DIR__."/../abstract/Manager.php");
require_once(__DIR__."/../entity/Article.php");

class ArticleManager extends Manager {
    public function readAll() {
        $query ="SELECT * FROM Article";
        
        $request = parent::prepareAndExecute($query);

        foreach ($request->fetchAll(PDO::FETCH_COLUMN) as $line){
            $result[] = new Article($line);
        }
        
        return $result;
    }
}

