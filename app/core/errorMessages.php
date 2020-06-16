<?php

//affichage des messages d'erreur
function display_error($path, $errMsg) {
    $pageName = 'error';
    
    //1. construit vue
    require(__DIR__."/../view/error.phtml");//appelle vue de l'erreur

    //2. vide variables inutiles car utilisees (ne reste que $pageFill et $_SESSION)
    unset($path, $scriptName, $errMsg, $_GET, $_POST);

    //3. appelle template
    require(__DIR__."/../view/common/template.phtml");
    exit();//mets fin au script
}

//regroupement des messages d'erreurs sous la forme $liste['fichier']['element']['probleme'] = 'message';
$errMsg['index']['configFile']['notSet']    = 'Fichier de configuration introuvable.';
$errMsg['index']['configFile']['notFull']   = 'Fichier de configuration incomplet ou incorrect.';

$errMsg['index']['sqlFile']['notSet']   = 'Script sql introuvable.';

$errMsg['index']['pythonFile']['notSet']   = 'Script python introuvable.';

$errMsg['router']['URL']['unknow'] = 'Erreur 404 : page introuvable.';


$errMsg['checker']['form']['filter'] = 'Valeurs incorrectes.';


$errMsg['controller']['login']['password'] = 'Nom d\'utilisateur ou mot de passe incorrect.';

$errMsg['controller']['register']['password']   = 'Mots de passes différents.';
$errMsg['controller']['register']['login']      = 'Nom d\'utilisateur déjà réservé';
