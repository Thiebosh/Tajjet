<?php
//1. charge fonctions bdd
require(__DIR__."/../model/monitor/DBMonitor.php");


//2. controle tables avec dates d'expiration
$tables = (new DBMonitor)->readOutdatedModulesNames();

var_dump($tables);

//3. met a jour lignes obsoletes des tables
$executable = $config['Python']['executable'];

foreach ($tables as $ligne) {
    $moduleScript = $ligne['module'];
    
    if (!file_exists("core/module_$moduleScript.py")) display_error($errMsg['index']['pythonFile']['notSet']);
    else {
        switch($moduleScript) {
            case "news":
                $moduleArgs = "";
                exec("'$executable' core/module_$moduleScript.py $moduleArgs");
                break;

            case "tv":
                $moduleArgs = "";
                exec("'$executable' core/module_$moduleScript.py $moduleArgs");
                break;

            case "meteo" :
                require(__DIR__."/../model/manager/TownManager.php");
                $towns = (new TownManager)->readAll();

                if ($towns != false) {
                    foreach ($towns as $town) {
                        $moduleArgs = $town->getLabel();
                        exec("'$executable' core/module_$moduleScript.py $moduleArgs");
                    }
                }
                break;
        }
    }
}

foreach (array_unique(array_column($tables, 'idFreq')) as $idFreq) {
    (new DBMonitor)->updateOutdatedFrequency($idFreq);
}
