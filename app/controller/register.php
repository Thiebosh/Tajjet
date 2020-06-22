<?php
if (isset($_SESSION["user"])) header('Location: index.php');

else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require(__DIR__."/../checker/$pageName.php");

    if (!isset($trustedPost['errMsgs'])) {
        if ($trustedPost['password'] != $trustedPost['passwordConf']) {
            $trustedPost['errMsgs'][] = $errMsg['controller']['register']['password'];
        }
        else {
            require_once(__DIR__."/../model/manager/UserManager.php");
            
            if ((new UserManager)->isUsedName($trustedPost['name'])) {
                $trustedPost['errMsgs'][] = $errMsg['controller']['register']['login'];
            }
            else {
                if (isset($trustedPost['town']) && $trustedPost['town'] !== false) {
                    require_once(__DIR__."/../model/manager/TownManager.php");
                    
                    $town = (new TownManager)->searchByName($trustedPost['town']);
                    if ($town !== false) $trustedPost['id_Town'] = $town->getId();
                    else {
                        exec('"'.$config['Python']['executable'].'" core/module_meteo.py '.$trustedPost['town'], $output, $return);
                        if (end($output) == '0') $trustedPost['id_Town'] = ((new TownManager)->readByName($trustedPost['town']))->getId();
                        else $trustedPost['errMsgs'][] = $errMsg['controller']['register']['town'];
                        unset($output);
                    }
                }

                $trustedPost['password'] = sha1($trustedPost['password']);//pas de mdp en clair

                if (!(new UserManager)->create(new User($trustedPost))) {
                    $trustedPost['errMsgs'][] = $errMsg['controller']['register']['db'];
                }
                else header('Location: index.php?user=login&inscript=true');
            }
        }
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
}