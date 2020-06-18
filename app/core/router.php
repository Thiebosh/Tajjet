<?php
//routeur de l'app : selon l'url, redirige vers le bon controleur

//1. determine page a afficher
if (!empty($_GET['action'])) {//!empty($var) <=> (isset($var) && $var!=false)

    switch (filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING)) {
        case 'upload_db':
            if (!is_readable($scriptName['sql'])) display_error($errMsg['index']['sqlFile']['notSet']);
            else {
                require_once('vendor/SqlImport/Import.php');

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
            $moduleScript = "news.py";
            $moduleArgs = "fr";
            if (!file_exists("core/" .$moduleScript)) display_error($errMsg['index']['pythonFile']['notSet']);
            else {
                var_dump('test');
                exec("".$config['Python']['executable']." core/$moduleScript 2>&1 $moduleArgs", $output, $return);
                
                echo("<br><hr>valeur de retour : $return<br>");
                var_dump($output);
                foreach ($output as $line) echo(htmlspecialchars(utf8_encode($line)).'<br>');//recuperation du flux ligne par ligne
                echo('<hr><br>');
            }
        break;

        case 'download_db':
            echo("todo - wip<br><br>");
        break;

        default:
            display_error($errMsg['router']['URL']['unknow']);
        break;
    }

    $pageName = 'home';//page d'accueil, sait qu'elle existe
}
else if (!empty($_GET['user'])) {//(isset($_SESSION["userId"])) {
    switch (filter_input(INPUT_GET, 'user', FILTER_SANITIZE_STRING)) {
        case 'login':
            $pageName = 'login';
        break;

        case 'profile':
            $pageName = 'profile';
        break;

        case 'logout':
            $pageName = 'logout';
        break;

        case 'register':
            $pageName = 'register';
        break;

        default:
            display_error($errMsg['router']['URL']['unknow']);
        break;
    }
}
else {//forcement a la fin, sinon existence de action pas verifiee
    $pageName = (!empty($_GET['page'])) ? filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING) : 'home';

    //teste existence de page
    if (!file_exists(__DIR__."/../controller/$pageName.php")) display_error($errMsg['router']['URL']['unknow']);
}


//3. nettoie les post vides et appelle le controller, qui genere les variables pour la vue, et la vue
foreach ($_POST as $key => $value) if ($value == "") unset($_POST[$key]);

try { 
    //3.1. declare variables pour la vue
    require(__DIR__."/../controller/$pageName.php");//sait qu'il existe

    //3.2. integre variables a la vue
    require(__DIR__."/../view/$pageName.phtml");//cense exister

    //3.3. vide variables inutiles car deja integrees (ne reste que $pageFill et $_SESSION)
    unset($path, $scriptName, $errMsg, $_GET, $_POST);

    //3.4. appelle en-tete utilisateur
    require(__DIR__."/../view/common/logged".(isset($_SESSION["user"]) ? "In" : "Out" ).".phtml");

    //3.4. appelle template
    require(__DIR__."/../view/common/template.phtml");
}
catch(Exception $erreur) {//appels bdd peut jeter des erreurs
    echo($erreur->getMessage().'<br>');
    echo('Fichier '.$erreur->getFile().', ligne '.$erreur->getLine());
}