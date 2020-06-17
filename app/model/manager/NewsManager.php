<?php
require_once(__DIR__."/../abstract/Manager.php");
require_once(__DIR__."/../entity/News.php");



class NewsManager extends Manager {
    public function getAllByIdNews($idNews){ //Pour tout récupérer selon si l'utilisateur a choisi "actu" ou "résultats sportifs", donc à partir de l'id News
        $query = 'SELECT * FROM news ORDER BY ID_news';

        $request = parent::getDBConnect()->prepare($query);
        if (!request->execute($idNews)) throw new Exception("Base De Donnéez : Echec d'exécution");

        foreach ($request->fetchAll(PDO::FETCH_COLUMN) as $line){
            $result[] = new News($line);
        }
        
        return $result;
    }
}
    
