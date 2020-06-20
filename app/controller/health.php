<?php
require_once(__DIR__."/../model/manager/HealthManager.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require(__DIR__."/../checker/$pageName.php");
    
    $health = (new HealthManager)->readTodayRecord($_SESSION['user']->getId());

    {
        if (isset($trustedPost['sleepTime']) && $trustedPost['sleepTime'] !== false) {
            if (!$health) {
                $init = array("idUser" => $_SESSION['user']->getId(),
                                "recordDate" => date("Y-m-d"),
                                "sleep" => $trustedPost['sleepTime']);
                (new HealthManager)->createTodayRecord(new Health($init));
            }
            else {
                $health->setSleep($trustedPost['sleepTime']);
                (new HealthManager)->updateTodayRecord($health);
            }
        }

        if (isset($trustedPost['weight']) && $trustedPost['weight'] !== false) {
            if (!$health) {
                $init = array("idUser" => $_SESSION['user']->getId(),
                                "recordDate" => date("Y-m-d"),
                                "weight" => $trustedPost['weight']);
                (new HealthManager)->createTodayRecord(new Health($init));
            }
            else {
                $health->setWeight($trustedPost['weight']);
                (new HealthManager)->updateTodayRecord($health);
            }
        }
    }
}


$listHealth = (new HealthManager)->readLast7Days($_SESSION['user']->getId());

if ($listHealth !== false) {
    //imc
    if ($_SESSION['user']->getHeight() != null && $listHealth[0]->getWeight() != null) {
        $imc = $listHealth[0]->getWeight() / pow($_SESSION['user']->getHeight(), 2);

        if ($imc !== false) {
            if ($imc < 18.5) {   
                $commIMC="Attention ! Vous êtes en insuffisance pondérale (maigreur), il vous faut gagner du poids !";
            } 
            else if ($imc <= 25) {   
                $commIMC="Très bien ! Vous entrez dans la catégorie Corpulence Normale, votre poids correspond à votre taille !";
            } 
            else if ($imc <= 30) { 
                $commIMC="Attention ! Vous êtes en surpoids, il vous faut perdre du poids !";
            } 
            else if ($imc <= 35) { 
                $commIMC="Attention ! Vous êtes obèse, prenez soin de votre corps et éliminez le surplus !";
            } 
            else if ($imc <= 40) { 
                $commIMC="Attention ! Vous avez atteint une obésité sévère, il devient urgent de faire quelque chose ! Consultez un médecin.";
            } 
            else {
                $commIMC="Vous avez atteint une obésité morbide. Si ce n'est pas déjà le cas, il faut vous soigner : votre vie est en danger. ";
            } 
        }
        //garde imc pour l'afficher
    }


    //Commentaire selon temps de sommeil enregistré et age
    if ($_SESSION['user']->getBirthDate() !== null) {
        $age = Age($_SESSION['user']->getBirthDate());
        $sleepTime = $listHealth[0]->getSleep();//verif 0 == plus recent

        //if ($sleepTime == null) 
        if (($age <= 17 && $sleepTime < 8) ||
            (17 < $age && $sleepTime < 7)) {
            $commSleepTod="Vous n'avez pas assez dormi cette nuit, il faut dormir plus.";
        }
        else if (($age <= 17 && $sleepTime < 10) ||
            (17 < $age && $age <= 64 && $sleepTime < 9) ||
            (65 < $age && $sleepTime < 8)) {
            $commSleepTod="Vous avez dormi suffisamment cette nuit, vous devez vous sentir en forme. ";
        }
        else {
            $commSleepTod="Vous avez trop dormi cette nuit, évitez de dépasser le temps de sommeil maximum recommandé. ";
        }

        unset($age, $sleepTime);
    }


    //Temps moyen de sommeil sur la dernière semaine + commentaire rythme
    foreach ($listHealth as $health) if ($health->getSleep() != null) $lastSleepTime[] = $health->getSleep();

    $tab_somm=somm($lastSleepTime);

    $temps_moyen=$tab_somm[0];
    $rythme=$tab_somm[1];
    $compteur=$tab_somm[2];

    if($rythme==false || ($rythme==true && (3<=$compteur))){
        $commRythme="Votre rythme de sommeil est irrégulier, essayez de maintenir des heures de couché et de levée constantes.";
    }
    else{
        $commRythme="Très bien, vous avez réussi à garder un temps de sommeil constant sur les 7 derniers jours, continuez ainsi pour rester en forme.";
    }

    unset($tab_somm, $temps_moyen, $rythme, $compteur);
}

var_dump($listHealth);

if ($listHealth !== false) foreach ($listHealth as $health) $json[] = $health->objectToJson();
else $health = "{}";


?>

<script>
    var variableRecuperee = <?= json_encode($listHealth) ?>;
</script>

 <?php
/*
//fait en js : nécessite sexe (bouton radio)

//Différence entre le poids idéal et le poids enregistré et commentaire
$size = $_SESSION['user']->getHeight() * 100;
$lorentzWeigth = ($size - 100) - (($size - 150) / ($sexe == "homme" ? 4 : 2.5));
$diff_weight = $listHealth[0]->getWeight() - $lorentzWeigth;

if( abs($diff_weight) <= 5) {   
    $commDiff="C'est très bien, vous êtes très proche du poids idéal pour votre taille ! Restez comme ça !";
} 
else if(abs($diff_weight) <= 10) {   
    $commDiff="Vous vous éloignez du poids idéal pour votre taille mais cela reste correcte, attention à ne pas vous en écarter davantage.";
}     
else { 
    $commDiff="Vous êtes trop loin du poids idéal pour votre taille, rapprochez vous-en pour ne pas mettre en danger votre santé.";
} 

unset($size, $diff_weight);//garde lorentz pour l'afficher
*/