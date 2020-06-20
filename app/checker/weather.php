<?php
if (isset($_POST['town'])) {
    $trustedPost['town'] = filter_input(INPUT_POST, 'town', FILTER_SANITIZE_STRING);
}


//si un "false" existe dans le tableau, avec comparaison des types
if(isset($trustePost)){
    if (in_array(false, $trustedPost, true)) $trustedPost['errMsgs'][] = $errMsg['checker']['form']['filter'];
}
//garde les false pour afficher class erreur