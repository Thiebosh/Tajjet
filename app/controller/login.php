<?php
if (isset($_SESSION["user"])) header('Location: index.php');//changer nom de page suffirait?

else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require(__DIR__."/../checker/$pageName.php");

    if (!isset($trustedPost['errMsgs'])) {
        require_once(__DIR__."/../model/manager/UserManager.php");

        $user = (new UserManager)->readByName($trustedPost['name']);
        
        if ($user === false) {
            $trustedPost['errMsgs'][] = $errMsg['controller']['login']['unknown'];
        }
        else {
            if ($user->getPassword() != sha1($trustedPost['password'])) {
                $trustedPost['errMsgs'][] = $errMsg['controller']['login']['password'];
            }
            else {
                $_SESSION["user"] = $user;

                header('Location: index.php');//changer nom de page suffirait?
            }
        }
    }
}
