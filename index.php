<?php
//point de depart de l'app :

//1. centralise noms de fichiers
$scriptName = array('config' => 'config.json',
                    'sql' => 'resource/db/everydaySunshine.sql',
                    'python' => 'requirements.txt');


//2. charge en memoire les messages d'erreurs et class user (mise en session safe) puis donnees de session
require_once('app/core/errorMessages.php');
require_once('app/model/entity/User.php');

session_start();//initie ou recupere $_SUPERVARIABLES


//3. lit le fichier de config
if (!is_readable($scriptName['config'])) {
    display_error($errMsg['index']['configFile']['notSet']);//teste existence et lecture
    exit();//condition sin equa none de fonctionnement
}
else {
    $config = json_decode(file_get_contents($scriptName['config']), true);//transforme l'objet en tableau associatif
    require('app/checker/configInput.php');
}


//4. dependances python : installation des librairies necessaires
if (!file_exists($scriptName['python'])) display_error($errMsg['index']['pythonFile']['notSet']);
else {
    exec("'".$config['Python']['executable']."' pip install -r ".$scriptName['python'], $output, $return);//tester fonctionnement
    /*
    echo("<br><hr>valeur de retour : $return<br>");
    var_dump($output);
    foreach ($output as $line) echo(htmlspecialchars(utf8_encode($line)).'<br>');//recuperation du flux ligne par ligne
    echo('<hr><br>');
    */
}


//5. monitoring de la bdd : connexion et mise a jour des donnees obsoletes
require("app/model/abstract/Manager.php");

Manager::setDBData($config['DB']['setup']['DBname'],
                    $config['DB']['connexion']['username'],
                    $config['DB']['connexion']['password'],
                    $config['DB']['setup']['characterSet']);

require_once('app/core/monitor.php');


//6. appelle le routeur et met fin au script
require_once('app/core/router.php');
exit();
