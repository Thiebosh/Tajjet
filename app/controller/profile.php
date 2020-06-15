<?php
//description logique générale de cette page
/*
if (!isset($_SESSION["userId"])) echo("rediriger vers page connexion");//ou ne pas afficher l'option
else {
    if (!isset($_POST["form"])) echo("afficher page sans reflechir");
    else {
        echo("tentative de modification : traiter le formulaire");
        if (isGood($_POST["form"])) echo("afficher page avec modifs");
        else echo("afficher page avec erreurs");
    }
}
*/


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

