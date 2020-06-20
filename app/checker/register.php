<?php
if (isset($_POST['username'], $_POST['password'], $_POST['passwordConf'])) {//champs required
    $trustedPost['name']         = filter_input(INPUT_POST, 'username',    FILTER_SANITIZE_STRING);//false si incorrect
    $trustedPost['password']     = filter_input(INPUT_POST, 'password',    FILTER_SANITIZE_STRING);
    $trustedPost['passwordConf'] = filter_input(INPUT_POST, 'passwordConf',FILTER_SANITIZE_STRING);
    

    //champs non required
    if (isset($_POST['avatar'])) {
        $trustedPost['avatar'] = $_POST['avatar'];//filter_input(INPUT_POST, 'avatar',  FILTER_SANITIZE_STRING); regarder comment faire
    }
    if (isset($_POST['birth'])) {
        $trustedPost['birthDate'] = filter_input(INPUT_POST, 'birth', FILTER_SANITIZE_STRING);
    }
    if (isset($_POST['height'])) {
        $trustedPost['height'] = filter_input(INPUT_POST, 'height', FILTER_VALIDATE_FLOAT);

        if (!$trustedPost['height']) {
            $tmp = Entity::stringToFloat($_POST['height']);
            if (is_numeric(Entity::stringToFloat($tmp))) $trustedPost['height'] = $tmp;
        }
    }
    if (isset($_POST['town'])) {
        $trustedPost['town'] = filter_input(INPUT_POST, 'town', FILTER_SANITIZE_STRING);
    }


    //si un "false" existe dans le tableau, avec comparaison des types
    if (in_array(false, $trustedPost, true)) $trustedPost['errMsgs'][] = $errMsg['checker']['form']['filter'];
}

