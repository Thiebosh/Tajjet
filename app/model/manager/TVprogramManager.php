<?php
require_once(__DIR__."/../abstract/Manager.php");
require_once(__DIR__."/../entity/TVprogram.php");

class TVprogramManager extends Manager {//pattern CRUD : create, read, update, delete + methodes pratiques
    public function readAllAfterTime($time){
        $query = "SELECT * 
                    FROM TVprogam 
                    WHERE End > Convert(time, :time)";
        $table = array('time' => $time);

        $request = parent::prepareAndExecute($query, $table);

        foreach ($request->fetchAll(PDO::FETCH_ASSOC) as $line){
            $result[] = new TVprogram($line);
        }

        return $result;
    }
}
