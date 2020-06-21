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

    $heure_moyenne=round  ( (array_sum($heures))/(sizeof($heures)),2); //moyenne des heures
    $min_moyenne=round((array_sum($minutes))/(sizeof($minutes)),2); //moyenne des minutes

    $liste_separee_heures_moyennes=explode('.',$heure_moyenne);
    $hmoy=$liste_separee_heures_moyennes[0]; //on sépare juste la partie entière des heures


    if(sizeof($liste_separee_heures_moyennes)==2 ){ //si partie décimale (1 seule décimale) aux heures moyennes
        $mmoy=$min_moyenne+round(60*$liste_separee_heures_moyennes[1]/10);
        
    }
    elseif(sizeof($liste_separee_heures_moyennes)==3 ){ //si 2 décimales aux heures moyennes
        $decimales=implode($liste_separee_heures_moyennes[1],$liste_separee_heures_moyennes[2]);
        $mmoy=$min_moyenne+round(60*$decimales/100);
    }
    elseif(sizeof($liste_separee_heures_moyennes)==1 ){ //si non
        $mmoy=$min_moyenne;
    }

    while($mmoy>=60){
            ++$hmoy;
            $mmoy=$mmoy-60;
    }
    
    if(0<=$mmoy && $mmoy<10){ //On affiche le 0 avant les minutes
        $mmoy="0".$mmoy;
    }
    $temps_moyen="$hmoy"."h"."$mmoy";

    $retour=array();
    array_push($retour,$temps_moyen);
    array_push($retour,$rythme);
    array_push($retour,$compteur);

    return $retour;
}

function skip_accents( $str, $charset='utf-8' ) {
    
    $str = htmlentities( $str, ENT_NOQUOTES, $charset );
    
    $str = preg_replace( '#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str );
    $str = preg_replace( '#&([A-za-z]{2})(?:lig);#', '\1', $str );
    $str = preg_replace( '#&[^;]+;#', '', $str );
    
    return $str;
}