<?php
//routeur de l'app : selon l'url, redirige vers le bon controleur

//1. determine page a afficher
if (!empty($_GET['action'])) {//!empty($var) <=> (isset($var) && $var!=false)

    switch (filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING)) {
        case 'upload_db':
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
        break;

        case 'fill_db':
            if (!file_exists($scriptName['python'])) display_error($path, $errMsg['index']['pythonFile']['notSet']);
            else {
                exec('"'.$config['Python']['executable'].'" "'.$scriptName['python'].'"', $output, $return);
                
                echo("<br>valeur de retour : $return<br><br>Texte affiché par python : <br>");
                foreach ($output as $line) echo(htmlspecialchars($line).'<br>');//recuperation du flux ligne par ligne
                echo('<br>');
            }
        break;

        case 'download_db':
            echo("todo - wip<br><br>");
        break;

        default:
            display_error($path, $errMsg['router']['URL']['unknow']);
        break;
    }

    $pageName = 'homePage';//page d'accueil, sait qu'elle existe
}
else {//forcement a la fin, sinon existence de action pas verifiee
    $pageName = (!empty($_GET['page'])) ? filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING) : 'homePage';

    //teste existence de page
    if (!file_exists(__DIR__."/../controller/$pageName.php")) display_error($path, $errMsg['router']['URL']['unknow']);
}


//3. vide variables inutiles s'il y en a puis appelle le controller
//unset($var1, $var2);

try { require(__DIR__."/../controller/$pageName.php"); }//sait qu'il existe
catch(Exception $erreur) {//appels bdd peut jeter des erreurs
    echo($erreur->getMessage().'<br>');
    echo('Fichier '.$erreur->getFile().', ligne '.$erreur->getLine());
    exit();
}
