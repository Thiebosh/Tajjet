<?php
require_once(__DIR__."/../model/manager/TypeManager.php");
require_once(__DIR__."/../model/manager/RecipeManager.php");

//array("Entrées","Plats","Dessert","Amuses bouches","Sauces","Accompagnements","Boissons");
$typeList = (new TypeManager)->readAll();



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
$recipe = (new RecipeManager)->readLast7Days($_SESSION['user']->getId());








$pageFill['recipe'] = array("id"=>1,
                            "titre" => "préparation de cookies",
                            "picture" => "url ou path",
                            "prepTime" => 120,
                            "cookTime" => 30,
                            "steps" => "blablabla",
                            "items" => array(array("name"=>"carotte(s)",
                                                    "quantity"=>3
                                                ),
                                                array("name"=>"farine",
                                                    "quantity"=>"500 g"
                                                )
                                                
                                        )
                            );

