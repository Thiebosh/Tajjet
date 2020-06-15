<?php
if (isset($_SESSION["user"])) header('Location: index.php');

else if (isset($_POST["form"])) {
    require("../checker/$pageName.php");

    if (!isset($trustedPost['errMsgs'])) {
        if ($trustedPost['password'] != $trustedPost['passwordConf']) {
            $trustedPost['errMsgs'][] = $errMsg['controller']['register']['password'];
        }
        else {
            require("../model/manager/UserManager.php");
            
            if ((new UserManager)->isUsedLogin($trustedPost['name'])) {
                $trustedPost['errMsgs'][] = $errMsg['controller']['register']['login'];
            }
            else {
                require("../model/manager/TownManager.php");

                $trustedPost['password'] = sha1($trustedPost['password']);//pas de mdp en clair

                $trustedPost['idTown'] = (new TownManager)->getIdTown($trustedPost['town']);//cree ligne si town existe pas

                (new UserManager)->addUser(new User($trustedPost));//ajouter verif a base de true false?
                
                header('Location: index.php?user=login');
            }
        }
    }
}