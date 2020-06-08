<?php
//namespace : uniquement si classe
//appel selon 3 possibilités :
//use vendor\SqlImport\Import; -> Import();
//use vendor\SqlImport; -> SqlImport\Import();
//vendor\SqlImport\Import();

//point de depart de l'app :
session_start();//initie ou recupere $_SUPERVARIABLES

$path = array('app' => 'core/app/', 'vendor' => 'core/vendor/', 'resource' => 'resource/');//centralise chemins d'acces generaux
$scriptName = array('sql' => '../BDD/appname.sql', 'python' => '../Data-recovery/python.py');


//1. charge en memoire les messages d'erreurs
require_once($path['app'].'errorMessages.php');


//2. si premier appel, initialise le setup du serveur
if (!isset($_SESSION['initialize'])) {
    //2.1. lit le json de config
    $filename = "../config.json";

    if (!is_readable($filename)) display_error($path, $errMsg['index']['configFile']['notSet']);//teste existence et lecture
    else {//ok
        $config = json_decode(file_get_contents($filename), true);//transforme l'objet en tableau associatif
        //var_dump($config);

        if (json_last_error() != JSON_ERROR_NONE //il y a une erreur

            || !(isset($config['DB']['connexion']['username']) && is_string($config['DB']['connexion']['username'])) //n'existe pas ou mauvais type
            || !(isset($config['DB']['connexion']['password']) && is_string($config['DB']['connexion']['password']))

            || !(isset($config['DB']['setup']['DBname'])         && is_string($config['DB']['setup']['DBname']))
            || !(isset($config['DB']['setup']['characterSet'])   && is_string($config['DB']['setup']['characterSet']))
            || !(isset($config['DB']['setup']['classification']) && is_string($config['DB']['setup']['classification']))
            
            || !(isset($config['DB']['script']['push']) && is_bool($config['DB']['script']['push']))
            || !(isset($config['DB']['script']['fill']) && is_bool($config['DB']['script']['fill']))
            || !(isset($config['DB']['script']['pull']) && is_bool($config['DB']['script']['pull']))

            || !(isset($config['Python']['executable']) && is_string($config['Python']['executable']))
            ) {
            display_error($path, $errMsg['index']['configFile']['notFull']);
        }
    }
    

    //2.2. si necessaire, importe le ficher bdd
    if ($config['DB']['script']['push']) {
        if (!is_readable($scriptName['sql'])) display_error($path, $errMsg['index']['sqlFile']['notSet']);
        else {
            require_once($path['vendor'].'SqlImport/Import.php');

            new vendor\SqlImport\Import($scriptName['sql'], 
                        $config['DB']['connexion']['username'], 
                        $config['DB']['connexion']['password'], 
                        $config['DB']['setup']['DBname'], 
                        $config['DB']['setup']['characterSet'], 
                        $config['DB']['setup']['classification'],
                        'localhost',
                        true, true);
        }
    }


    //2.3. si necessaire, appelle script python
    if ($config['DB']['script']['fill']) {
        if (!file_exists($scriptName['python'])) display_error($path, $errMsg['index']['pythonFile']['notSet']);
        else {
            exec('"'.$config['Python']['executable'].'" "'.$scriptName['python'].'"', $output, $return);
            echo("<br>valeur de retour : $return<br><br>Texte affiché par python : <br>");
            foreach ($output as $line) echo(htmlspecialchars($line));//recuperation du flux ligne par ligne
        }
    }


    //2.4. si necessaire, exporte le ficher bdd rempli
    if ($config['DB']['script']['pull']) {
        echo('todo');
    }


    //2.5. enregistre appel
    $_SESSION['initialize'] = true;
}


//3. vide variables inutiles puis appelle le routeur
unset($scriptName, $filename);
require_once($path['app'].'routeur.php');
session_destroy();