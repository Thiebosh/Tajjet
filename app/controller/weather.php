<?php
require_once(__DIR__."/../model/manager/WeatherManager.php");

$weatherList = $_SESSION['user']->getID_Town() != null ? (new WeatherManager)->readByIdTown($_SESSION['user']->getID_Town()) : false;

//var_dump($weatherList);


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
$aujourdhui=date("d");
$mois=date("M");
$annee=date("Y");


//3. transforme donnees (post traitement)
//tranformations goes here
$pageFill['moyTemp'] = ($pageFill['minTemp'] + $pageFill['maxTemp']) / 2;
