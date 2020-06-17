<?php
//point de depart de l'app :

//0. centralise chemins d'acces generaux
$path = array(  'app' => 'app/',
                'vendor' => 'vendor/',
                'resource' => 'resource/');
$scriptName = array('config' => 'config.json',
                    'sql' => 'resource/db/everydaySunshine.sql',
                    'python' => 'core/sport.py');


//1. charge en memoire les messages d'erreurs et class user (mise en session safe) puis donnees de session
require_once($path['app'].'core/errorMessages.php');
require_once($path['app'].'model/entity/User.php');

session_start();//initie ou recupere $_SUPERVARIABLES


//2. lit le json de config
if (!is_readable($scriptName['config'])) display_error($path, $errMsg['index']['configFile']['notSet']);//teste existence et lecture
else {//ok
    $config = json_decode(file_get_contents($scriptName['config']), true);//transforme l'objet en tableau associatif
    //var_dump($config);

    require($path['app'].'checker/configInput.php');
}


//3. monitoring de la bdd : connexion et mise a jour des donnees obsoletes
require("app/model/abstract/Manager.php");

Manager::setDBData($config['DB']['setup']['DBname'],
                    $config['DB']['connexion']['username'],
                    $config['DB']['connexion']['password'],
                    $config['DB']['setup']['characterSet']);


//4. appelle le routeur et met fin au script
require_once($path['app'].'core/router.php');
exit();
