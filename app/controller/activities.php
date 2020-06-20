<?php
require_once(__DIR__."/../model/manager/TVprogramManager.php");

foreach ((new TVprogramManager)->readAll(false) as $line) $activitiesListNotStarted[] = $line->objectToJson();
foreach ((new TVprogramManager)->readAll(true) as $line) $activitiesListStarted[] = $line->objectToJson();

$data = json_encode(array("notStarted" => $activitiesListNotStarted, "started" => $activitiesListStarted));

exit();