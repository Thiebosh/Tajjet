<?php
if (isset($_POST['recipeID'])) {
    $trustedPost['recipeID'] = filter_input(INPUT_POST, 'recipeID', FILTER_VALIDATE_INT);
}


//si un "false" existe dans le tableau, avec comparaison des types
if (in_array(false, $trustedPost, true)) $trustedPost['errMsgs'][] = $errMsg['checker']['form']['filter'];
//garde les false pour afficher class erreur
