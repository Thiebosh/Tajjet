<?php
require_once(__DIR__."/../model/manager/MuscleManager.php");
require_once(__DIR__."/../model/manager/SportManager.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require(__DIR__."/../checker/$pageName.php");
    
    if (isset($trustedPost['random'])) $sportList = array((new SportManager)->readRandom());
    else if (isset($trustedPost['muscle'])) {
        if (!isset($trustedPost['search'])) $sportList = (new SportManager)->readByMuscle($trustedPost['muscle']);//tous les sports du muscle
        else {
            if ($trustedPost['muscle'] == "Default") $sportList = (new SportManager)->searchByName($trustedPost['search']);
            else $sportList = (new SportManager)->searchByNameAndMuscle($trustedPost['muscle'], $trustedPost['search']);
        }
    }
    else if (isset($trustedPost['action'])) {
        
        (new SportManager)->resetProgram($_SESSION['user']->getId());
        if($trustedPost['nbExo']!=0){
            foreach ($trustedPost['listExo'] as $exo) {
                (new SportManager)->addToProgram($_SESSION['user']->getId(), $exo);
            }
        }

        if ($trustedPost['action'] == 'do' && isset($trustedPost['totalCalories'])) {
            require_once(__DIR__."/../model/manager/HealthManager.php");
            
            if (($health = (new HealthManager)->readTodayRecord($_SESSION['user']->getId())) == false) {
                $init = array("id_user" => $_SESSION['user']->getId(),
                                "calories" => -$trustedPost['totalCalories']);
                (new HealthManager)->createTodayRecord(new Health($init));
            }
            else {
                $health->setCalories($health->getCalories() - $trustedPost['totalCalories']);
                (new HealthManager)->updateTodayRecord($health);
            }
        }
    }
}

if (!isset($sportList) || $sportList == false) {
    if (isset($sportList) && $sportList == false) $trustedPost['errMsgs'][] = $errMsg['checker']['form']['filter'];//aucun résultat pour votre recherche
    $sportList = (new SportManager)->readAll();
}

$seanceList = (new SportManager)->readSeance($_SESSION['user']->getId()); //evolue selon le form
$muscleList = (new MuscleManager)->readAll();