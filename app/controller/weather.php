<?php
require_once(__DIR__."/../model/manager/WeatherManager.php");

$idTown = $_SESSION['user']->getID_Town();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require(__DIR__."/../checker/$pageName.php");

    
    if (isset($trustedPost['town']) && $trustedPost['town'] !== false) {
        require_once(__DIR__."/../model/manager/TownManager.php");

        $town = (new TownManager)->searchByName($trustedPost['town']);
        if ($town !== false) $idTown = $town->getId();
        else {
            exec('"'.$config['Python']['executable'].'" core/module_meteo.py '.$trustedPost['town'], $output, $return);
            if (end($output) == '0') $idTown = ((new TownManager)->readByName($trustedPost['town']))->getId();
            else $trustedPost['errMsgs'][] = $errMsg['controller']['weather']['town'];
            unset($output);
        }
    }
}


$weatherList = $_SESSION['user']->getID_Town() != null ? (new WeatherManager)->readByIdTown($idTown) : false;
