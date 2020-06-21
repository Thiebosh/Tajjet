<?php
require_once(__DIR__."/../model/manager/MuscleManager.php");
require_once(__DIR__."/../model/manager/SportManager.php");

$muscleList = (new MuscleManager)->readAll();

$sportList = (new SportManager)->readAll();

//var_dump($sportList);

//données de la seance