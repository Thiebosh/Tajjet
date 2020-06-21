<?php
require_once(__DIR__."/../model/manager/MuscleManager.php");
require_once(__DIR__."/../model/manager/SportManager.php");

$muscleList = (new MuscleManager)->readAll();
$seanceList = (new SportManager)->readSeance($_SESSION['user']->getId());

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require(__DIR__."/../checker/$pageName.php");
    
    if (isset($trustedPost['random'])) $sportList = array((new SportManager)->readRandom());
    else if (isset($trustedPost['muscle'])) {
        if (!isset($trustedPost['search'])) {
            //$sportList = tous les sports du muscle
        }
        else {
            //if ($trustedPost['muscle'] == "Default") //$sportList = recherche sur nom
            //else //$sportList = recherche sur nom avec filtre catégorie. Peut drop erreur "aucun résulat pour votre recherche"
        }
    }
    else if (isset($trustedPost['action'])) {
        if ($trustedPost['action'] == 'save') {
            //enregistrement mémoire
        }
        else {
            require_once("HealthManager.php");
        }
    }
}

if (!isset($sportList) || $sportList == false) {
    if (isset($sportList) && $sportList == false) $trustedPost['errMsgs'][] = $errMsg['checker']['form']['filter'];//aucun résultat pour votre recherche
    $sportList = (new SportManager)->readAll();
}

