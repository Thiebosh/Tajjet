<?php
//1. verifie entrees utilisateur ici (get/post)
//require("../checker/$pageName.php");


//2. appels bdd
//require_once('app/model/manager/HealthManager.php');//importe le reste
require_once('app/core/utils.php');
//call managers functions (load data here)


$pageFill['records'] = array(
                            array("recordDate" => 14-12-20,
                                    "weight" => 56,
                                    "calories" => 124,
                                    "sleep" => 30,
                                ),
                            array("recordDate" => 14-12-20,
                                "weight" => 56,
                                "calories" => 124,
                                "sleep" => 30,
                                )
                            );

$pageFill['user'] = array(
                        "height" => 1.60,
                        "birthDate" => 11-04-87,
                        "sexe" => "homme"
                        );


$sleepTime=7;
$age=Age("1980-06-10");

//3. transforme donnees (post traitement)
//tranformations goes here
for ($i = 0; $i < sizeof($pageFill['records']); ++$i) { 
    $pageFill['records'][$i]["imc"] = $pageFill['records'][$i]["weight"] / pow($pageFill['user']["height"], 2);
    
}

//Commentaire selon IMC
if($pageFill['records'][0]['imc'] < 18.5) {   
    $commIMC="Attention ! Vous êtes en insuffisance pondérale (maigreur), il vous faut gagner du poids !";
    } 

    elseif($pageFill['records'][0]['imc'] >= 18.5 && $pageFill['records'][0]['imc'] <= 25) {   
        $commIMC="Très bien ! Vous entrez dans la catégorie Corpulence Normale, votre poids correspond à votre taille !";
        } 

    elseif($pageFill['records'][0]['imc'] > 25 && $pageFill['records'][0]['imc'] <=30) { 
        $commIMC="Attention ! Vous êtes en surpoids, il vous faut perdre du poids !";
        } 

    elseif($pageFill['records'][0]['imc'] > 30 && $pageFill['records'][0]['imc'] <= 35) { 
        $commIMC="Attention ! Vous êtes obèse, prenez soin de votre corps et éliminez le surplus !";
        } 
    
    elseif($pageFill['records'][0]['imc'] >35 && $pageFill['records'][0]['imc'] <= 40) { 
        $commIMC="Attention ! Vous avez atteint une obésité sévère, il devient urgent de faire quelque chose ! Consultez un médecin.";
        } 
    
    else { 
        $commIMC="Vous avez atteint une obésité morbide. Si ce n'est pas déjà le cas, il faut vous soigner : votre vie est en danger. ";
        } 


//poids ideal (diff) -> order by date, relevé le plus recent en index 0
$size = $pageFill['user']["height"]*100;
$pageFill['user']['lorentz']['idealWeigth'] = ($size - 100) - (($size - 150) / ($pageFill['user']['sexe'] == "homme" ? 4 : 2.5));
$pageFill['user']['lorentz']['diffWeigth'] = $pageFill['user']['lorentz']['idealWeigth'] - $pageFill['records'][0]["weight"];

//Différence entre le poids idéal et le poids enregistré et commentaire
$diff_weight=$pageFill['records'][0]['weight']-$pageFill['user']['lorentz']['idealWeigth'];

if( abs($diff_weight) <= 5) {   
    $commDiff="C'est très bien, vous êtes très proche du poids idéal pour votre taille ! Restez comme ça !";
    } 

    elseif(abs($diff_weight)> 5 && abs($diff_weight) <= 10) {   
        $commDiff="Vous vous éloignez du poids idéal pour votre taille mais cela reste correcte, attention à ne pas vous en écarter davantage.";
        } 
    
    else { 
        $commDiff="Vous êtes trop loin du poids idéal pour votre taille, rapprochez vous-en pour ne pas mettre en danger votre santé.";
        } 

//Commentaire selon temps de sommeil enregistré et âge
if( 14<=$age && $age<= 17) {  
                                    
    if($sleepTime<8)
    {
        $commSleepTod="Vous n'avez pas assez dormi cette nuit, il faut dormir plus.";
    }
    elseif(8<=$sleepTime && $sleepTime<=10)
    {
        $commSleepTod="Vous avez dormi suffisamment cette nuit, vous devez vous sentir en forme. ";
    }
    elseif(10<$sleepTime)
    {
        $commSleepTod="Vous avez trop dormi cette nuit, évitez de dépasser le temps de sommeil maximum recommandé. ";
    }
}

elseif(18<=$age && $age<= 64) {   

    if($sleepTime<7)
    {
        $commSleepTod="Vous n'avez pas assez dormi cette nuit, il faut dormir plus.";
    }
    elseif(7<=$sleepTime && $sleepTime<=9)
    {
        $commSleepTod="Vous avez dormi suffisamment cette nuit, vous devez vous sentir en forme. ";
    }
    elseif(9<$sleepTime)
    {
        $commSleepTod="Vous avez trop dormi cette nuit, évitez de dépasser le temps de sommeil maximum recommandé. ";
    }

}
elseif($age>=65) {   

    if($sleepTime<7)
    {
        $commSleepTod="Vous n'avez pas assez dormi cette nuit, il faut dormir plus.";
    }
    elseif(7<=$sleepTime && $sleepTime<=8)
    {
        $commSleepTod="Vous avez dormi suffisamment cette nuit, vous devez vous sentir en forme. ";
    }
    elseif(8<$sleepTime)
    {
        $commSleepTod="Vous avez trop dormi cette nuit, évitez de dépasser le temps de sommeil maximum recommandé. ";
    }

}

//Temps moyen de sommeil sur la dernière semaine + commentaire rythme


$last7daysSleepTime= array("7:30","8:00","5:00","5:00","5:00","5:00","5:00");


$tab_somm=somm($last7daysSleepTime);

$temps_moyen=$tab_somm[0];
$rythme=$tab_somm[1];
$compteur=$tab_somm[2];

if($rythme==false || ($rythme==true && (3<=$compteur))){
    $commRythme="Votre rythme de sommeil est irrégulier, essayez de maintenir des heures de couché et de levée constantes.";
}
else{
    $commRythme="Très bien, vous avez réussi à garder un temps de sommeil constant sur les 7 derniers jours, continuez pour rester en forme.";
}

