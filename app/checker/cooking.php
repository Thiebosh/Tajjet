<?php
if (isset($_POST['recipeID'])) {
    $trustedPost['recipeID'] = filter_input(INPUT_POST, 'recipeID', FILTER_VALIDATE_INT);
}

if (isset($_POST['type'])) {
    $trustedPost['type'] = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING);
}

if (isset($_POST['search'])) {
    $trustedPost['search'] = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_STRING);
}


//si un "false" existe dans le tableau, avec comparaison des types
if (in_array(false, $trustedPost, true)) $trustedPost['errMsgs'][] = $errMsg['checker']['form']['filter'];
//garde les false pour afficher class erreur
