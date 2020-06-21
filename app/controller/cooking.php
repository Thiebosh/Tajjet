<?php
require_once(__DIR__."/../model/manager/TypeManager.php");
require_once(__DIR__."/../model/manager/RecipeManager.php");

$typeList = (new TypeManager)->readAll();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require(__DIR__."/../checker/$pageName.php");

    if (isset($trustedPost['recipeID']) && $trustedPost['recipeID'] != false) {//prepare recette
        $recipe = (new RecipeManager)->readByID($trustedPost['recipeID']);
        
        require_once(__DIR__."/../model/manager/HealthManager.php");

        if (($health = (new HealthManager)->readTodayRecord($_SESSION['user']->getId())) == false) {
            $init = array("id_user" => $_SESSION['user']->getId(),
                            "calories" => $recipe->getCalories());
            (new HealthManager)->createTodayRecord(new Health($init));//pb doublonnage
        }
        else {
            $health->setCalories($health->getCalories() + $recipe->getCalories());
            (new HealthManager)->updateTodayRecord($health);
        }
    }

    
    //si recherche, plat avec espace et type en dernier, concaténé
    //premier form
}
else {
    $recipe = (new RecipeManager)->readRandom();
}
/*
formulaire {
    checker
    if (nom != null) {
        $recipe = (new RecipeManager)->searchByName($trustedPost['name']);
        if ($recipe == false) {
            exec('"'.$config['Python']['executable'].'" core/module_recettes.py '.$trustedPost['name'], $output, $return);
            if (end($output) != '0') $recipe = (new RecipeManager)->readByName(end($output));
            else $trustedPost['errMsgs'][] = $errMsg['controller']['cooking']['recipe'];
            unset($output);
        }


concaténer type (pas d'espace)
        
        $town = (new TownManager)->searchByName($trustedPost['town']);
        if ($town !== false) $_SESSION['user']->setTown($town);
        else {
            exec('"'.$config['Python']['executable'].'" core/module_meteo.py '.$trustedPost['town'], $output, $return);
            if (end($output) == '0') $_SESSION['user']->setTown((new TownManager)->readByName($trustedPost['town']));
            else $trustedPost['errMsgs'][] = $errMsg['controller']['profil']['town'];
            unset($output);
        }
    }
    
}
*/
