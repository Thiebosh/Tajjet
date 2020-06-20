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
        
        if($import && !$stop) { //Si l'utilisateur a importé un fichier
            $dir="resource/image/avatars";
            if(!$ex){ //Si le dossier avatars n'existe pas, on le crée, on y ajoute le fichier et on le renomme avec le nom de l'utilisateur
                $creation=mkdir($dir,0777,true);
                if($creation){
                    $retour = copy($_FILES['avatar']['tmp_name'], $dir.'/'.$trustedPost['avatar']);
                    if($retour) {
                        rename($dir.'/' . $trustedPost['avatar'],$dir.'/' .$nom);
                        $avatar=$dir.'/' . $nom;
                    } 
                }
            }
            else{ //Si le dossier avatars existe, on regarde s'il existe déjà un avatar pour l'utilisateur, si oui on le supprime puis on le remplace
                if(file_exists($dir.$nom)){
                    unlink($dir.'/'.$nom);
                }
                $retour = copy($_FILES['avatar']['tmp_name'], $dir.'/'.$nom);
                    if($retour) {
                    $avatar=$dir.'/' . $nom;
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
if (!$import || $_FILES['avatar']['tmp_name']=='') { //S'il n'y a pas eu de nouvel import ou si modification de données personnelles sans changement d'avatar
    $dir="resource/image/avatars";
    $trouve=false;
    if($ex){ //Si le dossier avatars existe, on va chercher l'avatar déjà existant

        for($i=0;$i<sizeof(scandir($dir));++$i ){ //On parcourt le dossier avatars
            if(explode('.',scandir($dir)[$i])[0]==$nom_sans_ext){
                $avatar=$dir.'/'.$nom_sans_ext.'.'.explode('.',scandir($dir)[$i])[1];
                $trouve=true;
                
            }
            if($trouve==false){ //Sinon, l'avatar correspond à l'avatar par défaut
                $avatar="resource/image/defaultavatar.jpg";
            }
        }
    }
    else{ //Sinon, l'avatar correspond à l'avatar par défaut
        $avatar="resource/image/defaultavatar.jpg";
    }
    
}
