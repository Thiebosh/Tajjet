<?php
require_once(__DIR__."/../abstract/Manager.php");
require_once(__DIR__."/../entity/Theme.php");

class ThemeManager extends Manager {
    
    public function getAllByIDtheme($idtheme){ //Pour tout récupérer selon si l'utilisateur a choisi "actu" ou "résultats sportifs", donc à partir de l'id News
        $query = 'SELECT * FROM theme ORDER BY ID_theme';

        $request = parent::getDBConnect()->prepare($query);
        if (!request->execute()) throw new Exception("Base De Donnéez : Echec d'exécution");

        foreach ($request->fetchAll(PDO::FETCH_COLUMN) as $line){
            $result[] = new News($line);
        }
        
        return $result;
    }
}