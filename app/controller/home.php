<?php
$healthCond = $_SESSION['user']->getHeight() != null ? true : false;
$weatherCond = $_SESSION['user']->getTown()->getId() != null ? true : false;

$grid = array(  array(  array("link" => "sport",        "display" => "Sport",       "active" => true),
                        array("link" => "health",       "display" => "Santé",       "active" => $healthCond,    "missing" => "taille"),
                        array("link" => "news",         "display" => "News",        "active" => true)),
//2. appels bdd
//load bdd functions : require("../model/manager/*needed*.php");
//call managers functions (load data here)

                array(  array("link" => "weather",      "display" => "Météo",       "active" => $weatherCond,   "missing" => "ville"),
                        array("link" => "activities",   "display" => "Activités",   "active" => true),
                        array("link" => "cooking",      "display" => "Recettes",    "active" => true)));
