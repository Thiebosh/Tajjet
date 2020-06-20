<?php
if (!isset($_SESSION["user"])) header('Location: index.php');

else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require(__DIR__."/../checker/$pageName.php");

    require_once(__DIR__."/../model/manager/UserManager.php");

    {
        if (isset($trustedPost['name']) && $trustedPost['name'] !== false) {
            if ((new UserManager)->isUsedName($trustedPost['name'])) {
                $trustedPost['errMsgs'][] = $errMsg['controller']['profil']['login'];
            }
            else $_SESSION['user']->setName($trustedPost['name']);
        }
        
        if($import) { //Si l'utilisateur a importé un fichier
            $dir="resource/image/avatars";
            if(!file_exists($dir.$trustedPost['avatar'])){ //Si l'avatar n'a pas déjà été importé, alors on l'importe et l'affiche
                if(sizeof(scandir($dir))>2){ //Il y a déjà un fichier dans le dossier : on le supprime
                    $name=scandir($dir)[2];
                    unlink($dir.'/'.$name);
                }
                $retour = copy($_FILES['avatar']['tmp_name'], $dir.'/'.$trustedPost['avatar']);
                if($retour) {
                $avatar=$dir.'/' . $trustedPost['avatar'];
                } 
            }
            
        }
        
            
        
        if (isset($trustedPost['password'], $trustedPost['passwordConf']) && 
            $trustedPost['password'] !== false && $trustedPost['passwordConf'] !== false) {
            if ($trustedPost['password'] != $trustedPost['passwordConf']) {
                $trustedPost['errMsgs'][] = $errMsg['controller']['profil']['password'];
            }
            else $_SESSION['user']->setPassword(sha1($trustedPost['password']));
        }
        
        if (isset($trustedPost['birthDate']) && $trustedPost['birthDate'] !== false) {
            $_SESSION['user']->setBirthDate($trustedPost['birthDate']);
        }
        
        if (isset($trustedPost['height']) && $trustedPost['height'] !== false) {
            $_SESSION['user']->setHeight($trustedPost['height']);
        }
        
        if (isset($trustedPost['town']) && $trustedPost['town'] !== false) {
            require_once(__DIR__."/../model/manager/TownManager.php");

            $town = (new TownManager)->searchByName($trustedPost['town']);
            if ($town !== false) $_SESSION['user']->setTown($town);
            else {
                exec('"'.$config['Python']['executable'].'" core/module_meteo.py '.$trustedPost['town'], $output, $return);
                if (end($output) == '0') $_SESSION['user']->setTown((new TownManager)->readByName($trustedPost['town']));
                else $trustedPost['errMsgs'][] = $errMsg['controller']['profil']['town'];
                unset($output);
            }
        }
    }

    if (!in_array(false, $trustedPost, true) && (new UserManager)->update($_SESSION['user'])) {//si pas de pb, lance update ; si update error, lance message
        $trustedPost['errMsgs'][] = $errMsg['controller']['profil']['db'];
    }
}


require(__DIR__."/../checker/$pageName.php");
if (!$import) { //Import d'avatar
    $dir="resource/image/avatars";
    $name=scandir($dir)[2];
    if(file_exists($dir."/".$name)){ 
        $avatar=$dir.'/' . $name;
    }
}
