<?php
//1. verifie entrees utilisateur ici (get/post)
//require("../checker/$pageName.php");


//2. appels bdd
//load bdd functions : require("../model/manager/*needed*.php");
//call managers functions (load data here)
$pageFill['themeList'] = array("theme1", "theme2");
$pageFill['theme'] = array("Actu","Résultats sportifs");
$pageFill['summary'] = "blablabla";
$pageFill['source'] = array(array("URL" => "url1", "readingTime" => 30),
                            array("URL" => "url2", "readingTime" => 20)
                            );


//3. transforme donnees (post traitement)
$pageFill['globalTime'] = array_sum(array_column($pageFill['source'], "readingTime"));
