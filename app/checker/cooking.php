<?php
if (isset($_POST[''])) {
    $trustedPost['sleepTime'] = filter_input(INPUT_POST, 'sleepTime', FILTER_VALIDATE_INT);
}


//si un "false" existe dans le tableau, avec comparaison des types
if (in_array(false, $trustedPost, true)) $trustedPost['errMsgs'][] = $errMsg['checker']['form']['filter'];
//garde les false pour afficher class erreur
