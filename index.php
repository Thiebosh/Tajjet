<?php
//point de depart de l'app :
session_start();//initie ou recupere $_SUPERVARIABLES
//session_destroy();

//centralise chemins d'acces generaux
$path = array(  'app' => 'app/',
                'vendor' => 'vendor/',
                'resource' => 'resource/');
$scriptName = array('config' => 'config.json',
                    'sql' => 'resource/db/appname.sql',
                    'python' => 'core/main_function.py');


//1. charge en memoire les messages d'erreurs
require_once($path['app'].'core/errorMessages.php');


//2. lit le json de config
if (!is_readable($scriptName['config'])) display_error($path, $errMsg['index']['configFile']['notSet']);//teste existence et lecture
else {//ok
    $config = json_decode(file_get_contents($scriptName['config']), true);//transforme l'objet en tableau associatif
    //var_dump($config);

    if (json_last_error() != JSON_ERROR_NONE //il y a une erreur

        || !(isset($config['Python']['executable']) && is_string($config['Python']['executable']))//n'existe pas ou mauvais type

        || !(isset($config['DB']['connexion']['username']) && is_string($config['DB']['connexion']['username']))
        || !(isset($config['DB']['connexion']['password']) && is_string($config['DB']['connexion']['password']))

        || !(isset($config['DB']['setup']['DBname'])         && is_string($config['DB']['setup']['DBname']))
        || !(isset($config['DB']['setup']['characterSet'])   && is_string($config['DB']['setup']['characterSet']))
        || !(isset($config['DB']['setup']['classification']) && is_string($config['DB']['setup']['classification']))
        ) {
        display_error($path, $errMsg['index']['configFile']['notFull']);
    }
}


//3. monitoring de la bdd : mise a jour des donnees obsoletes
require_once($path['app'].'core/dbMonitoring.php');


//3. vide variables inutiles s'il y en a puis appelle le routeur
//unset($var1, $var2);
require_once($path['app'].'core/router.php');
