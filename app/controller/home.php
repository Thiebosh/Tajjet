<?php
$healthCond = $_SESSION['user']->getHeight() != null && $_SESSION['user']->getSex() ? true : false;
$weatherCond = $_SESSION['user']->getTown()->getId() != null ? true : false;

$grid = array(  array(  
                        array("link" => "cooking",      "display" => "Recettes",    "active" => true),
                        array("link" => "activities",   "display" => "Activités",   "active" => true),
                        array("link" => "weather",      "display" => "Météo",       "active" => $weatherCond,   "missing" => "ville")
                    ),

                array(  
                        array("link" => "news",         "display" => "Actualités",  "active" => true),
                        array("link" => "sport",        "display" => "Sport",       "active" => true),
                        array("link" => "health",       "display" => "Santé",       "active" => $healthCond,    "missing" => "taille et sexe")
                    )
                );


if ($weatherCond) {
    require_once(__DIR__."/../model/manager/WeatherManager.php");
    $weather = (new WeatherManager)->readNowByIdTown($_SESSION['user']->getTown()->getId());
}


if ($healthCond) {
    $size = $_SESSION['user']->getHeight() * 100;
    $lorentzWeight = intval(($size - 100) - (($size - 150) / ($_SESSION['user']->getSex() == "homme" ? 4 : 2.5)));
    unset($size);
}


require_once(__DIR__."/../model/manager/RecipeManager.php");
$cooking = (new RecipeManager)->readRandom();


require_once(__DIR__."/../model/manager/TVprogramManager.php");
$activities = (new TVprogramManager)->readRandomNow();


require_once(__DIR__."/../model/manager/ArticleManager.php");
$news = (new ArticleManager)->readRandom();

require_once(__DIR__."/../model/manager/SportManager.php");
$sport = (new SportManager)->readRandom();
