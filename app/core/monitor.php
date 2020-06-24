<?php
//1. charge fonctions bdd
require_once(__DIR__."/../model/monitor/DBMonitor.php");


//2. controle tables avec dates d'expiration
$tables = (new DBMonitor)->readOutdatedModulesNames();


//3. met a jour lignes obsoletes des tables
$executable = $config['Python']['executable'];

foreach ($tables as $ligne) {
    $moduleScript = $ligne['module'];
    
    if (!file_exists("core/module_$moduleScript.py")) display_error($errMsg['index']['pythonFile']['notSet']);
    else {
        switch($moduleScript) {
            case "tv":
                exec("\"$executable\" core/module_$moduleScript.py", $output, $return);
                if ($return) display_error($errMsg['monitor']['refresh']['fail']);
                unset($output);
                break;

            case "news":
                $pays = array("fr");
                foreach ($pays as $moduleArgs) {
                    exec("\"$executable\" core/module_$moduleScript.py $moduleArgs", $output, $return);
                    if ($return) display_error($errMsg['monitor']['refresh']['fail']);
                    unset($output);
                }
                break;

            case "meteo" :
                require(__DIR__."/../model/manager/TownManager.php");
                $towns = (new TownManager)->readAll();

                if ($towns != false) {
                    foreach ($towns as $town) {
                        $moduleArgs = $town->getLabel();
                        exec("\"$executable\" core/module_$moduleScript.py $moduleArgs", $output, $return);
                        if ($return) display_error($errMsg['monitor']['refresh']['fail']);
                        unset($output);
                    }
                }
                break;
        }
    }
}


foreach (array_unique(array_column($tables, 'idFreq')) as $idFreq) {
    (new DBMonitor)->updateOutdatedFrequency($idFreq);
}
