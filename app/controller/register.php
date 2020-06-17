<?php
if (isset($_SESSION["user"])) header('Location: index.php');

else if (isset($_POST["form"])) {
    require(__DIR__."/../checker/$pageName.php");

    if (!isset($trustedPost['errMsgs'])) {
        if ($trustedPost['password'] != $trustedPost['passwordConf']) {
            $trustedPost['errMsgs'][] = $errMsg['controller']['register']['password'];
        }
        else {
            require_once(__DIR__."/../model/manager/UserManager.php");
            
            echo("connexion 1");
            (new UserManager)->isUsedName($trustedPost['name']);
            echo("connexion 2");
            (new UserManager)->isUsedName($trustedPost['name']);
            
            if ((new UserManager)->isUsedName($trustedPost['name'])) {
                $trustedPost['errMsgs'][] = $errMsg['controller']['register']['login'];
            }
            else {
                if (isset($trustedPost['town'])) {
                    require_once(__DIR__."/../model/manager/TownManager.php");

                    $trustedPost['idTown'] = (new TownManager)->getIdTown($trustedPost['town']);//cree ligne si town existe pas
                }

                $trustedPost['password'] = sha1($trustedPost['password']);//pas de mdp en clair

                if (!(new UserManager)->addUser(new User($trustedPost))) {
                    $trustedPost['errMsgs'][] = $errMsg['controller']['register']['db'];
                }
                else header('Location: index.php?user=login');
            }
        }
    }
}