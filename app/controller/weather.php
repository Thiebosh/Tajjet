<?php
//1. verifie entrees utilisateur ici (get/post)
//require("../checker/$pageName.php");


//2. appels bdd
//load bdd functions : require("../model/manager/*needed*.php");
//call managers functions (load data here)
$pageFill['townList'] = array("ville1", "ville2");
$pageFill['townName'] = "ville";
$pageFill['minTemp'] = 5;
$pageFill['maxTemp'] = 25;
$pageFill['feltTemp'] = 12;
$pageFill['humidity'] = 40;
$pageFill['pressure'] = 12;
$pageFill['sky'] = "pluvieux";


//3. transforme donnees (post traitement)
//tranformations goes here
$pageFill['moyTemp'] = ($pageFill['minTemp'] + $pageFill['maxTemp']) / 2;
