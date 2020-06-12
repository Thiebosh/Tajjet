<?php
//description logique générale de cette page
/*
if (isset($_SESSION["user"])) echo("rediriger vers page home");
else {
    if (!isset($_POST["form"])) echo("afficher page sans reflechir");
    else {
        echo("tentative de connexion : traiter le formulaire");
        if (isGood($_POST["form"])) echo("rediriger vers page home");
        else echo("afficher page avec erreurs");
    }
}
*/



if (isset($_SESSION["user"])) header('Location: index.php');

else if (isset($_POST["form"])) {
    //1. verifie entrees utilisateur ici (post)
    require("../checker/$pageName.php");

    if ($correctPostData) {
        
    }
    si pb, affiche page avec erreurs

        teste variables

        si pas de pb, rediriger


        sinon, affiche page avec erreurs

    if ($isGood) header('Location: index.php');//ou profil

    else echo("afficher page avec erreurs");
}



$_SESSION["user"] = (new UserManager)->getUserByLogin("exemple");