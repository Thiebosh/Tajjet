<?php
//1. verifie entrees utilisateur ici (get/post)
//require("../checker/$pageName.php");


//2. appels bdd
//load bdd functions : require("../model/manager/*needed*.php");
//call managers functions (load data here)
$pageFill['recipe'] = array(array("titre" => "préparation de cookies",
                                    "picture" => "url ou path",
                                    "prepTime" => 120,
                                    "cookTime" => 30,
                                    "steps" => "blablabla",
                                    "calories" => "1234",
                                    "items" => array("name" => "carottes")
                                    )
                            );

$pageFill['userItems'] = array("name" => "carottes",
                                "consommable" => true//necessaire ici?
                            );
                                

//3. transforme donnees (post traitement)
for ($i = 0; $i < sizeof($pageFill)-1; ++$i) { 
    $pageFill['recipe'][$i]["globalTime"] = $pageFill['recipe'][$i]["prepTime"]+$pageFill['recipe'][$i]["cookTime"];
}
