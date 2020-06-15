<?php

if (isset($_POST['username'], $_POST['password'], $_POST['password_conf'])) {//champs required
    $trustedPost['name'] =      filter_input(INPUT_POST, 'username',    FILTER_SANITIZE_STRING);//false si incorrect
    $trustedPost['password'] =      filter_input(INPUT_POST, 'password',    FILTER_SANITIZE_STRING);
    $trustedPost['passwordConf'] =  filter_input(INPUT_POST, 'passwordConf',FILTER_SANITIZE_STRING);
    

    if (isset($_POST['avatar'], $_POST['birthDate'], $_POST['height'], $_POST['town'])) {//champs non required
        $trustedPost['avatar'] =  $_POST['avatar'];//filter_input(INPUT_POST, 'avatar',  FILTER_SANITIZE_STRING); regarder comment faire
        $trustedPost['birthDate'] = filter_input(INPUT_POST, 'birth',   FILTER_SANITIZE_STRING);//https://github.com/Thiebosh/Eveneo/blob/master/project/globalFunctions.php recuperer verifDateTime?
        $trustedPost['height'] =    filter_input(INPUT_POST, 'height',  FILTER_VALIDATE_FLOAT);
        $trustedPost['town'] =      filter_input(INPUT_POST, 'town',    FILTER_SANITIZE_STRING);
    }


    if (in_array(false, $trustedPost, true)) {//si un "false" existe dans le tableau, avec comparaison des types
        unset($trustedPost);
        $trustedPost['errMsgs'][] = $errMsg['checker']['form']['filter'];
    }
}
