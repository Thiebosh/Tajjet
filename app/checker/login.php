<?php

if (isset($_POST['username'], $_POST['password'])) {//facultatif car required dans formulaire mais empeche attaque externe
    $trustedPost['name'] = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);//false si incorrect
    $trustedPost['password'] = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    
    if (in_array(false, $trustedPost, true)) {//si un "false" existe dans le tableau, avec comparaison des types
        unset($trustedPost);
        $trustedPost['errMsgs'][] = $errMsg['checker']['form']['filter'];
    }
}
