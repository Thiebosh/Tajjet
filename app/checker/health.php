<?php
if (isset($_POST['sleepTime'])) {
    $trustedPost['sleepTime'] = filter_input(INPUT_POST, 'sleepTime', FILTER_SANITIZE_STRING);//false si incorrect
}

if (isset($_POST['weight'])) {
    $trustedPost['weight'] = filter_input(INPUT_POST, 'weight', FILTER_VALIDATE_FLOAT);
    
    if (!$trustedPost['weight']) {
        $tmp = Entity::stringToFloat($_POST['weight']);
        if (is_numeric(Entity::stringToFloat($tmp))) $trustedPost['weight'] = $tmp;
    }
}

//si un "false" existe dans le tableau, avec comparaison des types
if (in_array(false, $trustedPost, true)) $trustedPost['errMsgs'][] = $errMsg['checker']['form']['filter'];
//garde les false pour afficher class erreur
