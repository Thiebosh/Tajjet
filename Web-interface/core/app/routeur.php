<?php
//routeur de l'app : selon l'url, redirige vers le bon verificateur puis controleur

echo("routeur atteint");
exit();


if (!isset($_GET['action'])) {
    $pageName = (!empty($_GET['page'])) ? filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING) : 'accueil';//empty : vérifie existence et different de false

    try {//appels bdd peut jeter des erreurs
        if (file_exists("sanitizer/$pageName.php")) require("sanitizer/$pageName.php");//securise les entrees utilisateur si elles existent
        require("controller/".(file_exists("controller/$pageName.php" ?  $pageName : "erreur").".php");
    }
    catch(Exception $erreur) {
        $pageName = 'erreur';
        $variablePage['erreur']['message'] = $erreur->getMessage();
        $variablePage['erreur']['detail'] = 'Fichier ' . $erreur->getFile() . ', ligne ' . $erreur->getLine();
    }
}
else {
    if (!(isset($config['Python']['executable']) && is_string($config['Python']['executable']))

        || !(isset($config['DB']['setup']['DBname'])         && is_string($config['DB']['setup']['DBname']))
        || !(isset($config['DB']['setup']['characterSet'])   && is_string($config['DB']['setup']['characterSet']))
        || !(isset($config['DB']['setup']['classification']) && is_string($config['DB']['setup']['classification']))
        ) {
        display_error($path, $errMsg['index']['configFile']['notFull']);
    }

    switch (filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) {
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
                foreach ($output as $line) echo(htmlspecialchars($line));//recuperation du flux ligne par ligne
            }
        break;

        case 'download_db':
        break;
    }

    $pageName = "admin";
}


//affichage de la page
require("view/".(file_exists("view/$pageName.phtml") ?  $pageName : "erreur").".phtml");
