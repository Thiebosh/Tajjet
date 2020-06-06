<?php
//point de depart de l'app :
session_start();//initie ou recupere $_SUPERVARIABLES

$path = array('app' => 'core/app/', 'vendor' => 'core/vendor/', 'resource' => 'resource/');//centralise chemins d'acces generaux
$scriptName = array('sql' => '../BDD/appname.sql', 'python' => '../Data-recovery/main_function.py');


//1. charge en memoire les messages d'erreurs
require($path['app'].'errorMessages.php');


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
            require($path['vendor'].'SqlImport/Import.php');

            new Import($scriptName['sql'], 
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
            //première idée : censé fonctionner mais bloque
            //exec(escapeshellcmd($config['Python']['executable'].' '.$scriptName['python'].' arg1 arg2'), $out, $status);//securise puis appelle

            //idée à creuser : python in php -> https://github.com/jparise/php-python

            //à (re)voir : https://stackoverflow.com/questions/166944/calling-python-in-php

            //idée à creuser : tirer un exécutable du python -> http://www.py2exe.org/

            //idée à creuser : créer un script js avec node pour appeler le script python -> https://medium.com/swlh/run-python-script-from-node-js-and-send-data-to-browser-15677fcf199f

            //idée à creuser : utiliser un executable c pour faire le lien -> https://stackoverflow.com/questions/8532304/execute-root-commands-via-php

            //idée à creuser : tester sur ubuntu en ouvrant les droits -> https://stackoverflow.com/questions/32598420/cant-execute-python-script-from-php-document

            //dernier recours (imparfait) : rediriger vers l'url du script cgi, qui redirige vers php quand il a fini (dernière partie à retrouver)
            //header('Location: hi.py');
            //exit();



            $command = "python var/www/projets/Tajjet/Web-interface/python.py 2>&1";
            $pid = popen( $command,"r");
            while( !feof( $pid ) ) {
                echo fread($pid, 256);
                flush();
                ob_flush();
                usleep(100000);
            }
            pclose($pid);





            $exe = "C:/Users/Thibaut Juzeau/AppData/Local/Programs/Python/Python36/python.exe";
            $script = "python.py";

            echo("<br><br>à l'execution : 0 = pas de pb, 1 = pb<br>");


            echo("<br>TEST 0 : existence des fichiers<br>");
            echo("executable : ".file_exists($exe).", script : ".file_exists($script)."<br>");
            //echo(file_exists(__DIR__."/hi.py").'<br>');



            exec("$exe", $output, $return);
            echo("<br>TEST 1 : exec - run de python seul. Résultat : $return<br><br>");
            //var_dump($output);


            exec("python $script", $output, $return);
            echo("<br>TEST 2 : exec - run de hi par raccourci python. Résultat : $return<br><br>");


            exec("$exe $script", $output, $return);
            echo("<br>TEST 3 : exec - run de hi par executable python. Résultat : $return<br><br>");


            ob_start();
            passthru("$exe $script");
            $output = ob_get_clean(); 
            echo("<br>TEST 4 : passthru - run de hi par executable python. Résultat : échec<br><br>");


            $result = shell_exec("python $script");
            echo("<br>TEST 5 : shell_exec - run de hi par raccourci python. Résultat : $result<br><br>");


            $result = shell_exec("$exe $script");
            echo("<br>TEST 6 : shell_exec - run de hi par raccourci python. Résultat : $result<br><br>");


            $result = system("python $script");
            echo("<br>TEST 7 : system - run de hi par raccourci python. Résultat : $result<br><br>");


            $result = system("$exe $script");
            echo("<br>TEST 8 : system - run de hi par raccourci python. Résultat : $result<br><br>");
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
require($path['app'].'routeur.php');
session_destroy();