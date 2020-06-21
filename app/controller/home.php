<?php
$healthCond = $_SESSION['user']->getHeight() != null ? true : false;
$weatherCond = $_SESSION['user']->getTown()->getId() != null ? true : false;

$grid = array(  array(  array("link" => "sport",        "display" => "Sport",       "active" => true),
                        array("link" => "health",       "display" => "Santé",       "active" => $healthCond,    "missing" => "taille"),
                        array("link" => "news",         "display" => "News",        "active" => true)),

                array(  array("link" => "weather",      "display" => "Météo",       "active" => $weatherCond,   "missing" => "ville"),
                        array("link" => "activities",   "display" => "Activités",   "active" => true),
                        array("link" => "cooking",      "display" => "Recettes",    "active" => true)));


if ($weatherCond) {
    require_once(__DIR__."/../model/manager/WeatherManager.php");
    $weather = (new WeatherManager)->readByIdTown($_SESSION['user']->getTown()->getId())[0];
}


require_once(__DIR__."/../model/manager/RecipeManager.php");
$cooking = (new RecipeManager)->readAlea();


require_once(__DIR__."/../model/manager/TVprogramManager.php");
$activities = (new TVprogramManager)->readRandomNow();

