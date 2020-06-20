<?php
require_once(__DIR__."/../model/manager/TVprogramManager.php");

foreach ((new TVprogramManager)->readAll(false) as $line) {
    $tmp =  $line->objectToJson();
    if ($tmp != false) $activitiesListNotStarted[] = $tmp;
}
foreach ((new TVprogramManager)->readAll(true) as $line) {
    $tmp =  $line->objectToJson();
    if ($tmp != false) $activitiesListStarted[] = $tmp;
}

$data = json_encode($activitiesListNotStarted);

exit();