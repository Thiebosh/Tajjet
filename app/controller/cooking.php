<?php
require_once(__DIR__."/../model/manager/TypeManager.php");
require_once(__DIR__."/../model/manager/RecipeManager.php");

$typeList = (new TypeManager)->readAll();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $recipe = "result";
}
else {
    $recipe = (new RecipeManager)->readAlea();
}
//plat avec espace et type en dernier, concaténé
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
