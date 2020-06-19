<?php
//1. charge fonctions bdd
require(__DIR__."/../model/monitor/DBMonitor.php");


//2. controle tables avec dates d'expiration
$tables = (new DBMonitor)->readOutdatedModulesNames();


//3. met a jour lignes obsoletes des tables
$executable = $config['Python']['executable'];

foreach ($tables as $ligne) {
    $moduleScript = $ligne['module'];
    
    if (!file_exists("core/module_$moduleScript.py")) display_error($errMsg['index']['pythonFile']['notSet']);
    else {
        switch($moduleScript) {
            case "news":
                $moduleArgs = "";
                break;

            case "meteo"
                //1 appel par ville
                break;

            case "tv":
                //
                break;
        }
        exec("'$executable' core/module_$moduleScript.py $moduleArgs", $output, $return);
    }
}

foreach (array_unique(array_column($tables, 'idFreq')) as $idFreq) {
    (new DBMonitor)->updateOutdatedFrequency($idFreq);
}

//exit();
