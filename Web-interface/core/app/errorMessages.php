<?php

//affichage des messages d'erreur
function display_error($path, $errMsg) {
    $pageFill['errMsg'] = $errMsg;//ajoute message d'erreur a la liste
    require($path['resource'].'view/error.phtml');//appelle vue de l'erreur
    exit();//mets fin au script
}

//regroupement des messages d'erreurs sous la forme $liste['fichier']['element']['probleme'] = 'message';
$errMsg['index']['configFile']['notSet']    = 'Fichier de configuration introuvable.';
$errMsg['index']['configFile']['notFull']   = 'Fichier de configuration incomplet ou incorrect.';

$errMsg['index']['sqlFile']['notSet']   = 'Script sql introuvable.';

$errMsg['index']['pythonFile']['notSet']   = 'Script python introuvable.';