<?php
if (isset($_POST['username'])) {
    $trustedPost['name'] = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);//false si incorrect
}

if (isset($_FILES['avatar']['tmp_name'])) { //Si l'utilisateur a importé un fichier
    $import=true;
    $stop=false;
    $taille_maxi=600000;
    $extensions = array('.png', '.gif', '.jpg', '.jpeg',".JPG");
    $taille = filesize($_FILES['avatar']['tmp_name']); //On récupère la taille et l'extension du fichier
    $extension = strrchr($_FILES['avatar']['name'], '.'); 
    $nom=$_SESSION['user']->getName().$extension;
    $dir="resource/image/avatars";
    if(!file_exists($dir)){ //On vérifie si le dossier avatars existe
        $ex=false;
    }
    elseif(file_exists($dir)){
        $ex=true;
    }
    if($_FILES['avatar']['tmp_name']==''){ //Si modification des infos personnelles sans changement d'avatar
        $stop=true;
    }

    if($taille>$taille_maxi)
    {
        $erreur = 'Votre fichier dépasse la taille maximale';
    }
    if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
    {
        $erreur = 'Votre fichier doit être de type png, gif, jpg ou jpeg';
    }
    if(!isset($erreur) && !$stop){
        $trustedPost['avatar']=$_FILES['avatar']['name'];
    }
    

}
elseif(!isset($_FILES['avatar']['tmp_name'])){
    $import=false;
    $nom_sans_ext=$_SESSION['user']->getName();
    $dir="resource/image/avatars";
    if(!file_exists($dir)){
        $ex=false;
    }
    elseif(file_exists($dir)){
        $ex=true;
    }
}

if (isset($_POST['password'], $_POST['passwordConf'])) {
    $trustedPost['password']     = filter_input(INPUT_POST, 'password',    FILTER_SANITIZE_STRING);
    $trustedPost['passwordConf'] = filter_input(INPUT_POST, 'passwordConf',FILTER_SANITIZE_STRING);
}
else if (isset($_POST['password']) || isset($_POST['passwordConf'])) {
    $trustedPost['errMsgs'][] = $errMsg['checker']['form']['notBothPassword'];
    
    $trustedPost['password'.(isset($_POST['password']) ? 'Conf' : '')] = false;
}

if (isset($_POST['birthDate'])) {
    $trustedPost['birthDate'] = filter_input(INPUT_POST, 'birthDate', FILTER_SANITIZE_STRING);//https://github.com/Thiebosh/Eveneo/blob/master/project/globalFunctions.php recuperer verifDateTime?
}

if (isset($_POST['height'])) {
    $trustedPost['height'] = filter_input(INPUT_POST, 'height', FILTER_VALIDATE_FLOAT);

    if (!$trustedPost['height']) {
        $tmp = Entity::stringToFloat($_POST['height']);
        if (is_numeric(Entity::stringToFloat($tmp))) $trustedPost['height'] = $tmp;
    }
}

if (isset($_POST['town'])) {
    $trustedPost['town'] = filter_input(INPUT_POST, 'town', FILTER_SANITIZE_STRING);
}


//si un "false" existe dans le tableau, avec comparaison des types
if(isset($trustePost)){
    if (in_array(false, $trustedPost, true)) $trustedPost['errMsgs'][] = $errMsg['checker']['form']['filter'];
}
//garde les false pour afficher class erreur