<?php
//1. charge fonctions bdd
require(__DIR__."/../model/monitor/DBMonitor.php");


//2. controle tables avec dates d'expiration
$tables = (new DBMonitor)->readOutdatedModulesNames();


//3. met a jour lignes obsoletes des tables
foreach ($tables as $ligne) {
    $moduleScript = $ligne['module'];

    
    if (!file_exists("core/module_$moduleScript.py")) display_error($errMsg['index']['pythonFile']['notSet']);
    else {
        exec("'".$config['Python']['executable']."' core/module_$moduleScript.py 2>&1 $moduleArgs", $output, $return);
        
        echo("<br><hr>valeur de retour : $return<br>");
        var_dump($output);
        foreach ($output as $line) echo(htmlspecialchars(utf8_encode($line)).'<br>');//recuperation du flux ligne par ligne
        echo('<hr><br>');
    }
}

foreach (array_unique(array_column($tables, 'idFreq')) as $idFreq) {
    (new DBMonitor)->updateOutdatedFrequency($idFreq);
}

exit();
