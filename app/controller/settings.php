<?php
//1. verifie entrees utilisateur ici (get/post)
//require("../checker/$pageName.php");


//2. appels bdd
//load bdd functions : require("../model/manager/*needed*.php");
//call managers functions (load data here)
$pageFill['account'] = array("username"=>"Dark Vador",
                                "e-mail"=>"darkvad@gmail.com",
                                "avatar"=>"url/path"
                            );

$pageFill['personal'] = array("age"=>20,
                            "town"=>"Lille",
                            "height"=>1.80,
                            "weight"=>75,
                            "favourite_team"=>"LOSC"
                        );
//3. transforme donnees (post traitement)
//tranformations goes here
