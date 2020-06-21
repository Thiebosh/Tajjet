<?php
$healthCond = $_SESSION['user']->getHeight() != null ? true : false;
$weatherCond = $_SESSION['user']->getTown()->getId() != null ? true : false;

$grid = array(  array(  
                        array("link" => "cooking",      "display" => "Recettes",    "active" => true),
                        array("link" => "activities",   "display" => "Activités",   "active" => true),
                        array("link" => "weather",      "display" => "Météo",       "active" => $weatherCond,   "missing" => "ville")
                    ),

                array(  
                        array("link" => "news",         "display" => "Actualités",  "active" => true),
                        array("link" => "sport",        "display" => "Sport",       "active" => true),
                        array("link" => "health",       "display" => "Santé",       "active" => $healthCond,    "missing" => "taille")
                    )
                );


if ($weatherCond) {
    require_once(__DIR__."/../model/manager/WeatherManager.php");
    $weather = (new WeatherManager)->readNowByIdTown($_SESSION['user']->getTown()->getId());
}


require_once(__DIR__."/../model/manager/RecipeManager.php");
$cooking = (new RecipeManager)->readRandom();

/*
require_once(__DIR__."/../model/manager/TVprogramManager.php");
$activities = (new TVprogramManager)->readRandomNow();
*/

require_once(__DIR__."/../model/manager/ArticleManager.php");
$news = (new ArticleManager)->readRandom();
