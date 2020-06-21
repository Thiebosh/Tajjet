<?php
require_once(__DIR__."/../model/manager/MuscleManager.php");
require_once(__DIR__."/../model/manager/SportManager.php");

$muscleList = (new MuscleManager)->readAll();

$sportList = (new SportManager)->readAll();

$seanceList = (new SportManager)->readSeance($_SESSION['user']->getId());
