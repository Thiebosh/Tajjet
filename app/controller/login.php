<?php
if (isset($_SESSION["user"])) header('Location: index.php');//changer nom de page suffirait?

else if (isset($_POST["form"])) {
    require("../checker/$pageName.php");

    if (!isset($trustedPost['errMsgs'])) {
        require("../model/manager/UserManager.php");

        $user = (new UserManager)->getUserByLogin($trustedPost['name']);
        
        if ($user->getPassword() != sha1($trustedPost['password'])) {
            $trustedPost['errMsgs'][] = $errMsg['controller']['login']['password'];
        }
        else {
            $_SESSION["user"] = $user;

            header('Location: index.php');//changer nom de page suffirait?
        }
    }
}
