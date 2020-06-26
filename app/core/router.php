<?php
//routeur de l'app : selon l'url, redirige vers le bon controleur

//1. determine page a afficher
if (!empty($_GET['action'])) {//!empty($var) <=> (isset($var) && $var!=false)
    switch (filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING)) {
        case 'setup_db':
            if (!is_readable($scriptName['sql'])) display_error($errMsg['index']['sqlFile']['notSet']);
            else {
                
                if (!isset($_GET['part'])) {
                    require_once('vendor/SqlImport/Import.php');

                    new vendor\SqlImport\Import($scriptName['sql'], 
                                                $config['DB']['connexion']['username'], 
                                                $config['DB']['connexion']['password'], 
                                                $config['DB']['setup']['DBname'], 
                                                $config['DB']['setup']['characterSet'], 
                                                $config['DB']['setup']['classification'],
                                                'localhost',
                                                true, true);

                    
                    header('Location: index.php?action=setup_db&part=2');
                    
                }
                else{
                    $modules = array( //anciennement fill_db
                        array('name' => 'tv'),
                        array('name' => 'sport'),
                        array('name' => 'news', 'param' => 'fr'),
                        array('name' => 'meteo', 'param' => 'Lille'),
                        array('name' => 'recettes', 'param' => 'boeuf bourguignon platprincipal')
                    );

                    foreach ($modules as $module) {
                        if (!file_exists("core/module_".$module['name'].".py")) display_error($errMsg['index']['pythonFile']['notSet']);
                        else {
                            exec('"'.$config['Python']['executable'].'" core/module_'.$module['name'].'.py '.(isset($module['param']) ? $module['param'] : ''), $output, $return);
                            unset($output);
                        }
                    }
                    unset($_SESSION['user']);
                    header('Location: index.php');
                }
            }
        break;

        case 'backup_db':
            
            require_once('vendor/SqlExport/Export.php');
            
            Export_Database('localhost',
                            $config['DB']['connexion']['username'],
                            $config['DB']['connexion']['password'],
                            $config['DB']['setup']['DBname'],
                            false,
                            "EverydaySunshine_backup",
                            false,
                            array("article", "channel", "sky", "tvprogram", "weather"));
        break;

        case 'load_backup':
            var_dump($_GET);
            $dir="resource/db/Backup/";
            if (!isset($_GET['part'])) {
                $backup_name="EverydaySunshine_backupStructure.sql";
                if(!file_exists($dir)) display_error($errorMsg);
                else{
                    if (!is_readable($dir.$backup_name)) display_error($errMsg['index']['sqlFile']['notSet']);
                    else {
                        require_once('vendor/SqlImport/Import.php');
                        new vendor\SqlImport\Import($dir.$backup_name, 
                                                    $config['DB']['connexion']['username'], 
                                                    $config['DB']['connexion']['password'], 
                                                    $config['DB']['setup']['DBname'], 
                                                    $config['DB']['setup']['characterSet'], 
                                                    $config['DB']['setup']['classification'],
                                                    'localhost',
                                                    true, true);
                    }
                }
                header("Location: index.php?action=load_backup&part=2");
            }
            else{
                if($_GET['part']==2){
                    $backup_name="EverydaySunshine_backupData.sql";
                    if(!file_exists($dir)) display_error($errorMsg);
                    else{
                        if (!is_readable($dir.$backup_name)) display_error($errMsg['index']['sqlFile']['notSet']);
                        else {
                            require_once('vendor/SqlImport/Import.php');
                            new vendor\SqlImport\Import($dir.$backup_name, 
                                                        $config['DB']['connexion']['username'], 
                                                        $config['DB']['connexion']['password'], 
                                                        $config['DB']['setup']['DBname'], 
                                                        $config['DB']['setup']['characterSet'], 
                                                        $config['DB']['setup']['classification'],
                                                        'localhost',
                                                        false, false);

                        }
                    }
                    header("Location: index.php?action=load_backup&part=3");
                }
                else {
                    $backup_name="EverydaySunshine_backupConstraints.sql";
                    if(!file_exists($dir)) display_error($errorMsg);
                    else{
                        if (!is_readable($dir.$backup_name)) display_error($errMsg['index']['sqlFile']['notSet']);
                        else {
                            require_once('vendor/SqlImport/Import.php');
                            new vendor\SqlImport\Import($dir.$backup_name, 
                                                        $config['DB']['connexion']['username'], 
                                                        $config['DB']['connexion']['password'], 
                                                        $config['DB']['setup']['DBname'], 
                                                        $config['DB']['setup']['characterSet'], 
                                                        $config['DB']['setup']['classification'],
                                                        'localhost',
                                                        false, false);
                                                        
                            $modules = array( //anciennement fill_db
                                array('name' => 'tv'),
                                array('name' => 'sport'),
                                array('name' => 'news', 'param' => 'fr'),
                                array('name' => 'meteo', 'param' => 'Lille'),
                                array('name' => 'recettes', 'param' => 'boeuf bourguignon platprincipal')
                            );
        
                            foreach ($modules as $module) {
                                if (!file_exists("core/module_".$module['name'].".py")) display_error($errMsg['index']['pythonFile']['notSet']);
                                else {
                                    exec('"'.$config['Python']['executable'].'" core/module_'.$module['name'].'.py '.(isset($module['param']) ? $module['param'] : ''), $output, $return);
                                    unset($output);
                                }
                            }
                            unset($_SESSION['user']);
                            header('Location: index.php');

                        }
                    }
                }
            }
            display_error($errMsg['router']['backup']['loadFail']);//redirection dans chaque cas
        break;


        case 'download_db':
            require_once('vendor/SqlExport/Export.php');
            
            Export_Database('localhost',
                            $config['DB']['connexion']['username'],
                            $config['DB']['connexion']['password'],
                            $config['DB']['setup']['DBname'],
                            false,
                            "EverydaySunshine_backup.sql",
                            true,
                            array("article", "channel", "sky", "tvprogram", "weather"));
        break;

        default:
            display_error($errMsg['router']['URL']['unknow']);
        break;
    }

    $pageName = 'home';//page d'accueil, sait qu'elle existe
}
else if (!empty($_GET['user'])) {
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

if (!isset($_SESSION['user']) && !($pageName == 'login' || $pageName == 'register')) $pageName = 'login';//connexion obligatoire


//3. nettoie les post vides et appelle le controller, qui genere les variables pour la vue, et la vue
foreach ($_POST as $key => $value) if ($value == "") unset($_POST[$key]);

try { 
    //3.1. declare variables pour la vue
    require(__DIR__."/../controller/$pageName.php");//sait qu'il existe

    //3.2. vide variables inutiles car deja utilisees (ne reste que $pageFill et $_SESSION)
    unset($scriptName, $errMsg, $_GET, $_POST);

    //3.3. integre variables a la vue
    require(__DIR__."/../view/$pageName.phtml");//cense exister

    //3.4. appelle en-tete utilisateur
    require(__DIR__."/../view/common/logged".(isset($_SESSION["user"]) ? "In" : "Out" ).".phtml");

    //3.4. appelle template
    require(__DIR__."/../view/common/template.phtml");
}
catch(Exception $erreur) {//appels bdd peut jeter des erreurs
    echo($erreur->getMessage().'<br>');
    echo('Fichier '.$erreur->getFile().', ligne '.$erreur->getLine());
}