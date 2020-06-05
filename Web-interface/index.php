<?php
//point de depart de l'app :
session_start();//initie ou recupere $_SUPERVARIABLES

$path = array('app' => 'core/app/', 'vendor' => 'core/vendor/', 'resource' => 'resource/');//centralise chemins d'acces generaux


//1. charge en memoire les messages d'erreurs
require($path['app'].'errorMessages.php');


//2. si premier appel, initialise le setup du serveur
if (!isset($_SESSION['initialize'])) {
    echo("initialise");
    //2.1. lit le json de config
    $filename = "../config.json";

    if (!is_readable($filename)) {//teste existence et lecture
        display_error($errMsg['index']['configFile']['notSet']);
    }
    else {//ok
        $config = json_decode(file_get_contents($filename), true);//transforme l'objet en tableau associatif
        //var_dump($config);

        if (json_last_error() != JSON_ERROR_NONE //il y a une erreur

            || !(isset($config['DB']['connexion']['username'])  && is_string($config['DB']['connexion']['username'])) //n'existe pas ou mauvais type
            || !(isset($config['DB']['connexion']['password'])  && is_string($config['DB']['connexion']['password']))

            || !(isset($config['DB']['setup']['name'])              && is_string($config['DB']['setup']['name']))
            || !(isset($config['DB']['setup']['characterSet'])      && is_string($config['DB']['setup']['characterSet']))
            || !(isset($config['DB']['setup']['classification'])    && is_string($config['DB']['setup']['classification']))
            
            || !(isset($config['DB']['script']['name']) && is_bool($config['DB']['script']['name']))
            || !(isset($config['DB']['script']['push']) && is_bool($config['DB']['script']['push']))
            || !(isset($config['DB']['script']['pull']) && is_bool($config['DB']['script']['pull']))
            ) {
            display_error($errMsg['index']['configFile']['notFull']);
        }
    }


    //2.2. si necessaire, importe le ficher bdd
    if ($config['DB']['script']['push']) {
        $filename = '../BDD/'.$config['DB']['script']['name'].'.sql';

        if (!is_readable($filename)) display_error($errMsg['index']['sqlFile']['notSet']);
        else {
            require($path['vendor'].'SqlImport/Import.php');

            new Import($filename, 
                        $config['DB']['connexion']['username'], 
                        $config['DB']['connexion']['password'], 
                        $config['DB']['setup']['name'], 
                        $config['DB']['setup']['characterSet'], 
                        $config['DB']['setup']['classification'],
                        'localhost',
                        true, true);
        }
    }


    //2.3. enregistre appel
    $_SESSION['initialize'] = true;
}


//3. appelle le routeur
require($path['app'].'routeur.php');
//session_destroy();