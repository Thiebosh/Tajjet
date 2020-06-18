<?php
//1. verifie entrees utilisateur ici (get/post)
//require("../checker/$pageName.php");


//2. appels bdd
//load bdd functions : 
require_once(__DIR__."/../model/manager/RecipeManager.php");
require_once(__DIR__."/../model/manager/TypeManager.php");
require_once(__DIR__."/../model/manager/NeedManager.php");
require_once(__DIR__."/../model/manager/IngredientManager.php");
require_once(__DIR__."/../model/manager/HaveManager.php");
require_once(__DIR__."/../model/manager/UserManager.php");
//call managers functions (load data here)



/*$retour = (new RecipeManager())->getByLabel("test"); //On récupère toutes les infos de la recette en fonction du nom de celle-ci
$type= (new TypeManager())->getAll(); //On récupère tous les types de plats pour la liste déroulante

$quantity= (new IncludManager())->getQuantityByIdItemAndRecipe(1,2);*/ //On récupère la quantité des ingrédients nécessaires à la recette

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
