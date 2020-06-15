<?php 
if (json_last_error() != JSON_ERROR_NONE //il y a une erreur

    || !(isset($config['Python']['executable']) && is_string($config['Python']['executable']))//n'existe pas ou mauvais type

    || !(isset($config['DB']['connexion']['username']) && is_string($config['DB']['connexion']['username']))
    || !(isset($config['DB']['connexion']['password']) && is_string($config['DB']['connexion']['password']))

    || !(isset($config['DB']['setup']['DBname'])         && is_string($config['DB']['setup']['DBname']))
    || !(isset($config['DB']['setup']['characterSet'])   && is_string($config['DB']['setup']['characterSet']))
    || !(isset($config['DB']['setup']['classification']) && is_string($config['DB']['setup']['classification']))
    ) {
    display_error($path, $errMsg['index']['configFile']['notFull']);
}
