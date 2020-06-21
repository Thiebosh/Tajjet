<?php
if (isset($_POST['random'])) $trustedPost['random'] = true;

else if (isset($_POST['muscle'])) {
    $trustedPost['muscle'] = filter_input(INPUT_POST, 'muscle', FILTER_SANITIZE_STRING);

    if (isset($_POST['search'])) $trustedPost['search'] = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_STRING);
}
else if (isset($_POST['nbExo']) && (isset($_POST['save']) || isset($_POST['do']))) {
    $trustedPost['action'] = isset($_POST['save']) ? 'save' : 'do';

    $trustedPost['nbExo'] = filter_input(INPUT_POST, 'nbExo', FILTER_VALIDATE_INT);

    if ($trustedPost['nbExo'] != false) {
        for ($i = 0; $i < $trustedPost['nbExo']; ++$i) {
            if (isset($_POST['exo'.$i])) {
                $id = filter_input(INPUT_POST, 'exo'.$i, FILTER_VALIDATE_INT);
                if ($id != false) $trustedPost['listExo'][] = $id;
                else echo("erreur<br>");
            }
            else echo("oubli<br>");
        }
    }
    else echo("probleme<br>");
}


//si un "false" existe dans le tableau, avec comparaison des types
if(isset($trustedPost)){
    if (in_array(false, $trustedPost, true)) $trustedPost['errMsgs'][] = $errMsg['checker']['form']['filter'];
}
