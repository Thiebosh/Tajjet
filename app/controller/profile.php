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
        
        if(isset($import)&&$import==true && isset($stop) &&$stop==false) { //Si l'utilisateur a importé un fichier
            $dir="resource/image/avatars";
            if(isset($trustedPost['error'])){
                $erreur=$trustedPost['error'];
                
            }
            else{
                if(!$exist){ //Si le dossier avatars n'existe pas, on le crée, on y ajoute le fichier et on le renomme avec le nom de l'utilisateur
                    $creation=mkdir($dir,0777,true);
                    if($creation){
                        
                        $retour = copy($_FILES['avatar']['tmp_name'], $dir.'/'.$trustedPost['avatar']);
                        if($retour) {
                            rename($dir.'/' . $trustedPost['avatar'],$dir.'/' .$trustedPost['username_ext_file']);
                            $avatar=$dir.'/' . $trustedPost['username_ext_file'];
                        } 
                    }
                }
                else{ //Si le dossier avatars existe, on regarde s'il existe déjà un avatar pour l'utilisateur, si oui on le supprime puis on le remplace
                    
                    for($i=0;$i<sizeof(scandir($dir));++$i){ //On parcourt le dossier et si un avatar pour l'utilisateur est déjà présent, on le supprime (peu importe le format)
                        
                        if(file_exists($dir.'/'.$trustedPost['username'].$trustedPost['extensions'][$i])){
                            unlink($dir.'/'.$trustedPost['username'].$trustedPost['extensions'][$i]);
                            
                        }
                    }
                    $retour = copy($_FILES['avatar']['tmp_name'], $dir.'/'.$trustedPost['username_ext_file']);
                        if($retour) {
                        $avatar=$dir.'/' . $trustedPost['username_ext_file'];
                        } 
                }
            }
        }
        elseif(isset($stop)&& $stop==true ){ //Si l'utilisateur modifie ses informations personnelles sans importer d'avatar
            if (!(isset($_FILES['avatar']['name'])) || $_FILES['avatar']['name']=='') { //S'il n'y a pas eu de nouvel import ou si modification de données personnelles sans changement d'avatar
                $dir="resource/image/avatars";
                $trouve=false;
                $username=$_SESSION['user']->getName();
                if(file_exists($dir)){ //Si le dossier avatars existe, on va chercher l'avatar déjà existant
                    for($i=0;$i<sizeof(scandir($dir));++$i ){ //On parcourt le dossier avatars
                        if(explode('.',scandir($dir)[$i])[0]==$username){
                            $avatar=$dir.'/'.$username.'.'.explode('.',scandir($dir)[$i])[1];
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
        }

        if (isset($trustedPost['password'], $trustedPost['passwordConf']) && 
            $trustedPost['password'] !== false && $trustedPost['passwordConf'] !== false) {
            if ($trustedPost['password'] != $trustedPost['passwordConf']) {
                $trustedPost['errMsgs'][] = $errMsg['controller']['profil']['password'];
            }
            else $_SESSION['user']->setPassword(sha1($trustedPost['password']));
        }
        
        if( (isset($trustedPost['name']) && $trustedPost['name'] !== false) || (isset($trustedPost['password'], $trustedPost['passwordConf']) && 
        $trustedPost['password'] !== false && $trustedPost['passwordConf'] !== false) ){ //Si l'utilisateur modifie ses identifiants, on affiche quand même l'avatar
            if (!(isset($_FILES['avatar']['name'])) || $_FILES['avatar']['name']=='') { //S'il n'y a pas eu de nouvel import ou si modification de données personnelles sans changement d'avatar
                $dir="resource/image/avatars";
                $trouve=false;
                $username=$_SESSION['user']->getName();
                if(file_exists($dir)){ //Si le dossier avatars existe, on va chercher l'avatar déjà existant
                    for($i=0;$i<sizeof(scandir($dir));++$i ){ //On parcourt le dossier avatars
                        if(explode('.',scandir($dir)[$i])[0]==$username){
                            $avatar=$dir.'/'.$username.'.'.explode('.',scandir($dir)[$i])[1];
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

else //S'il n'y a pas d'import, on affiche quand même l'avatar
{
    if (!(isset($_FILES['avatar']['name'])) || $_FILES['avatar']['name']=='') { //S'il n'y a pas eu de nouvel import ou si modification de données personnelles sans changement d'avatar
        $dir="resource/image/avatars";
        $trouve=false;
        $username=$_SESSION['user']->getName();
        if(file_exists($dir)){ //Si le dossier avatars existe, on va chercher l'avatar déjà existant

            for($i=0;$i<sizeof(scandir($dir));++$i ){ //On parcourt le dossier avatars
                if(explode('.',scandir($dir)[$i])[0]==$username){
                    $avatar=$dir.'/'.$username.'.'.explode('.',scandir($dir)[$i])[1];
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

}



