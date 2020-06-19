<?php
//1. verifie entrees utilisateur ici (get/post)
//require("../checker/$pageName.php");


//2. appels bdd
//load bdd functions : require("../model/manager/*needed*.php");
//call managers functions (load data here)
//if (weather->isgood()) {
require_once(__DIR__."/../model/Manager/ChannelManager.php");
require_once(__DIR__."/../model/Manager/TVprogramManager.php");
require_once(__DIR__."/../model/Manager/WeatherManager.php");
require_once(__DIR__."/../model/Manager/TownManager.php");
require_once(__DIR__."/../model/Manager/SkyManager.php");
$pageFill['indoor'] = array(
                            array(
                                "channel" => 1,
                                "program" => array(
                                                array(
                                                        "begin" => 15-50,
                                                        "end" => 16-20,
                                                        "title" => "petits meurtes d'agatha christie",
                                                        "synopsis" => "lui l'est venu, lui l'est mourru, lui l'est coupâââââble",
                                                        "genre" => array("genre1", "genre4")
                                                    ),
                                                    
                                                array(
                                                    "begin" => 16-30,
                                                    "end" => 18-10,
                                                    "title" => "eragon",
                                                    "synopsis" => "dragons, épées, magie...",
                                                    "genre" => array("genre2")
                                                    )
                                                )
                            ),
                            array(
                                "channel" => 2,
                                "program" => array(
                                                array(
                                                        "begin" => 12-30,
                                                        "end" => 13-00,
                                                        "title" => "midi les zouzou",
                                                        "synopsis" => "c'est vieux, je sais",
                                                        "genre" => array("genre3", "genre4")
                                                    ),
                                                    
                                                array(
                                                    "begin" => 16-00,
                                                    "end" => 19-40,
                                                    "title" => "eyeshield 21",
                                                    "synopsis" => "pareil, c'est pas tout récent",
                                                    "genre" => array("genre1", "genre3", "genre4")
                                                    )
                                                )

                            )
                        );
//}
//else {
$pageFill['outdoor'] = array(
                            array(
                                "label" => "musée",
                                "distance" => 10,
                                "category" => "cat1",
                            ),
                            array(
                                "label" => "parc",
                                "distance" => 2,
                                "category" => "cat3",
                            ),
                            array(
                                "label" => "restau",
                                "distance" => 2.4,
                                "category" => "cat2",
                            )
                        );
//$time = "02:23";
//$test[] = (new TVprogramManager)->readAllAfterTime($time);

//var_dump($test);
//}


//3. transforme donnees (post traitement)
//durée
