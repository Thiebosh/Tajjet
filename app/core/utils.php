<?php

//Ce fichier regroupe toutes les fonctions utiles qui peut-être appelées à différents endroits


//Fonction qui calcule l'âge selon la date du jour

function Age($date) {
    $tab_date=explode('-',$date);
    $annee_naissance=$tab_date[0];
    $Age = date("Y") - $annee_naissance; 
    if (date('md') < date('md', strtotime($date))) { 
        return $Age - 1; 
    } 
    return $Age; 
} 

function somm($last7daysSleepTime) {
    //On compte le nombre de fois où le temps de sommeil s'écarte de plus d'1h d'une nuit à l'autre, au-delà de 3 fois, on considère que le rythme n'est pas bon. 
    //On le considère également mauvais s'il y a un écart d'au moins 3h entre 2 nuits consécutives.
    //On calcule également le temps moyen de sommeil
    $decomp=array();
    $compteur=0;
    $rythme=true;
    $heures=array();
    $minutes=array();

    for($i=0;$i<sizeof($last7daysSleepTime); ++$i) {
        array_push($decomp,explode(':',$last7daysSleepTime[$i]));

        array_push($heures, $decomp[$i][0] );
        array_push($minutes, $decomp[$i][1]);
        if($i>0 && ( 1<abs($heures[$i-1]-$heures[$i]) )) {
            ++$compteur;

            if(3 <= abs($heures[$i-1]-$heures[$i])){
                $rythme=false;
            }
        }
    }

    $heure_moyenne=(round  ( (array_sum($heures))/(sizeof($heures)),2));
    $min_moyenne=(array_sum($minutes))/(sizeof($minutes));
    $temps_moyen=$heure_moyenne+($min_moyenne/60);

    $hmoy=explode('.',$heure_moyenne)[0];
    $mmoy=round($min_moyenne+(60*explode('.',$heure_moyenne)[1]/100));

    $temps_moyen="$hmoy"."h"."$mmoy";

    $retour=array();
    array_push($retour,$temps_moyen);
    array_push($retour,$rythme);
    array_push($retour,$compteur);

    return $retour;
}