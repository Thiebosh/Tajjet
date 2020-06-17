<?php
if (isset($_POST['username'])) {
    $trustedPost['name'] = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);//false si incorrect
}

if (isset($_POST['avatar'])) {
    $trustedPost['avatar'] = $_POST['avatar'];//filter_input(INPUT_POST, 'avatar', FILTER_SANITIZE_STRING); regarder comment faire
}

if (isset($_POST['password'], $_POST['passwordConf'])) {
    $trustedPost['password']     = filter_input(INPUT_POST, 'password',    FILTER_SANITIZE_STRING);
    $trustedPost['passwordConf'] = filter_input(INPUT_POST, 'passwordConf',FILTER_SANITIZE_STRING);
}
else if (isset($_POST['password']) || isset($_POST['passwordConf'])) {
    $trustedPost['errMsgs'][] = $errMsg['checker']['form']['notBothPassword'];
    
    $trustedPost['password'.(isset($_POST['password']) ? 'Conf' : '')] = false;
}

if (isset($_POST['birthDate'])) {
    $trustedPost['birthDate'] = filter_input(INPUT_POST, 'birthDate', FILTER_SANITIZE_STRING);//https://github.com/Thiebosh/Eveneo/blob/master/project/globalFunctions.php recuperer verifDateTime?
}

if (isset($_POST['height'])) {
    $trustedPost['height'] = filter_input(INPUT_POST, 'height', FILTER_VALIDATE_FLOAT);

    if (!$trustedPost['height']) {
        $tmp = str_replace(',','.',filter_input(INPUT_POST, 'height', FILTER_SANITIZE_STRING));
        if (is_numeric($tmp)) $trustedPost['height'] = floatval($tmp);
    }
}

if (isset($_POST['town'])) {
    $trustedPost['town'] = filter_input(INPUT_POST, 'town', FILTER_SANITIZE_STRING);
}


//si un "false" existe dans le tableau, avec comparaison des types
if (in_array(false, $trustedPost, true)) $trustedPost['errMsgs'][] = $errMsg['checker']['form']['filter'];
//garde les false pour afficher class erreur