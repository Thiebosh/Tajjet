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

    
    if (isset($trustedPost['search']) && isset($trustedPost['type']) && $trustedPost['type']!="Type de préparation") {
        $trustedPost['type'] = strtolower(skip_accents($trustedPost['type']));

        require_once(__DIR__."/../model/manager/TypeManager.php");

        $idType =  (new TypeManager)->readByName($trustedPost['type'])->getId();
        $recipe = (new RecipeManager)->searchByName($trustedPost['search'], $idType);

        $trustedPost['type'] = str_replace(' ','',$trustedPost['type']);
        if ($recipe === false) {
            exec('"'.$config['Python']['executable'].'" core/module_recettes.py '.$trustedPost['search'].' '.$trustedPost['type'], $output, $return);
            if (end($output) != '1') $recipe = (new RecipeManager)->readByName(skip_accents(\ForceUTF8\Encoding::toUTF8(end($output))), $idType);
            else $trustedPost['errMsgs'][] = $errMsg['controller']['cooking']['search'];
            unset($output);
        }
    }
}

if (!isset($recipe) || $recipe == null) $recipe = (new RecipeManager)->readRandom();
