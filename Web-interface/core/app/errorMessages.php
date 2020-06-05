<?php

//affichage des messages d'erreur
function display_error($errMsg) {
    $pageFill['errMsgs'][] = $errMsg;//ajoute message d'erreur à la liste
    require($path['resource'].'view/error.php');//appelle vue de l'erreur
    exit();//mets fin au script
}

//regroupement des messages d'erreurs sous la forme $liste['fichier']['element']['probleme'] = 'message';
$errMsg['index']['configFile']['notSet']    = 'Fichier de configuration introuvable.';
$errMsg['index']['configFile']['notFull']   = 'Fichier de configuration incomplet ou incorrect.';

$errMsg['index']['sqlFile']['notSet']   = 'Script sql introuvable.';