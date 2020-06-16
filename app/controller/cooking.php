<?php
//1. verifie entrees utilisateur ici (get/post)
//require("../checker/$pageName.php");


//2. appels bdd
//load bdd functions : 
require(__DIR__."/../model/manager/RecipeManager.php");
//call managers functions (load data here)

require(__DIR__."/../model/manager/RecipeManager.php");


$retour = (new RecipeManager())->getByLabel("test");

var_dump($retour);

$pageFill['recipe'] = array(array("id"=>1,
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
                                ),
                                array("id"=>2,
                                    "titre" => "tarte aux abricots",
                                    "picture" => "url ou path",
                                    "prepTime" => 120,
                                    "cookTime" => 30,
                                    "steps" => "blablabla",
                                    "items" => array(array("name"=>"abricot(s)",
                                                            "quantity"=>8
                                                        ),
                                                        array("name"=>"farine",
                                                            "quantity"=>"300 g"
                                                        )
                                                        
                                                )
                                    )
                            );

$pageFill['userItems'] = array("name" => "carottes",
                                "consommable" => true//necessaire ici?
                            );

$pageFill['type']=array("Entrées","Plats","Dessert","Amuses bouches","Sauces","Accompagnements","Boissons");


//3. transforme donnees (post traitement)
for ($i = 0; $i < sizeof($pageFill['recipe']); ++$i) { 
    $pageFill['recipe'][$i]["globalTime"] = $pageFill['recipe'][$i]["prepTime"] + $pageFill['recipe'][$i]["cookTime"];
}
