<?php

//affichage des messages d'erreur
function display_error($errMsg) {
    $pageName = 'error';
    
    //1. construit vue
    require(__DIR__."/../view/error.phtml");//appelle vue de l'erreur

    //2. vide variables inutiles car utilisees (ne reste que $pageFill et $_SESSION)
    unset($scriptName, $errMsg, $_GET, $_POST);

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


$errMsg['checker']['form']['filter']            = 'Valeurs incorrectes.';
$errMsg['checker']['form']['notBothPassword']   = 'Mot de passe ou confirmation manquant.';


$errMsg['controller']['login']['unknown']   = 'Nom d\'utilisateur ou mot de passe incorrect.';//ne peut pas preciser, sinon fait fuiter info
$errMsg['controller']['login']['password']  = $errMsg['controller']['login']['unknown'];


$errMsg['controller']['register']['password']   = 'Mots de passes différents.';
$errMsg['controller']['register']['login']      = 'Nom d\'utilisateur déjà utilisé.';
$errMsg['controller']['register']['db']         = 'Problème d\'enregistrement, veuillez réessayer.';


$errMsg['controller']['profil']['password'] = $errMsg['controller']['register']['password'];
$errMsg['controller']['profil']['login']    = $errMsg['controller']['register']['login'];
$errMsg['controller']['profil']['db']       = $errMsg['controller']['register']['db'];
