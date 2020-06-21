<?php
if (isset($_POST['random'])) $trustedPost['random'] = true;

else if (isset($_POST['muscle'])) {
    $trustedPost['muscle'] = filter_input(INPUT_POST, 'muscle', FILTER_SANITIZE_STRING);

    if (isset($_POST['search'])) $trustedPost['search'] = true;
}
else if (isset($_POST['nbExo']) && (isset($_POST['save']) || isset($_POST['do']))) {
    
}


//si un "false" existe dans le tableau, avec comparaison des types
if(isset($trustedPost)){
    if (in_array(false, $trustedPost, true)) $trustedPost['errMsgs'][] = $errMsg['checker']['form']['filter'];
}
//garde les false pour afficher class erreur
