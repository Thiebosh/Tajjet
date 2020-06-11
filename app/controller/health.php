<?php
//1. verifie entrees utilisateur ici (get/post)
//require("../checker/$pageName.php");


//2. appels bdd
//load bdd functions : require("../model/manager/*needed*.php");
//call managers functions (load data here)
$pageFill['records'] = array(
                            array("recordDate" => 14-12-20,
                                    "weight" => 56,
                                    "calories" => 124,
                                    "sleep" => 30,
                                ),
                            array("recordDate" => 14-12-20,
                                "weight" => 56,
                                "calories" => 124,
                                "sleep" => 30,
                                )
                            );

$pageFill['user'] = array(
                        "height" => 1.60,
                        "birthDate" => 11-04-87,
                        "sexe" => "homme"
                        );


//3. transforme donnees (post traitement)
//tranformations goes here
for ($i = 0; $i < sizeof($pageFill['records']); ++$i) { 
    $pageFill['records'][$i]["imc"] = $pageFill['records'][$i]["weight"] / pow($pageFill['user']["height"], 2);
    
}

//poids ideal (diff) -> order by date, relevé le plus recent en index 0
$size = $pageFill['user']["height"]*100;
$pageFill['user']['lorentz']['idealWeigth'] = ($size - 100) - (($size - 150) / ($pageFill['user']['sexe'] == "homme" ? 4 : 2.5));
$pageFill['user']['lorentz']['diffWeigth'] = $pageFill['user']['lorentz']['idealWeigth'] - $pageFill['records'][0]["weight"];
