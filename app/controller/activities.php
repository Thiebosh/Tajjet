<?php
require_once(__DIR__."/../model/manager/TVprogramManager.php");

$data = (new TVprogramManager)->readAll(false);
if ($data != false) foreach ($data as $line) $activitiesListNotStarted[] = $line->objectToJson();

$data = (new TVprogramManager)->readAll(true);
if ($data != false) foreach ($data as $line) $activitiesListStarted[] = $line->objectToJson();

unset($data);
if (isset($activitiesListNotStarted)) $data["notStarted"] = $activitiesListNotStarted;
if (isset($activitiesListStarted)) $data["started"] = $activitiesListStarted;

$data = json_encode($data);


if ($_SESSION['user']->getTown()->getId() != null) {
    require_once(__DIR__."/../model/manager/WeatherManager.php");
    $weather = (new WeatherManager)->readNowByIdTown($_SESSION['user']->getTown()->getId());
}