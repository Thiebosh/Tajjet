<?php
require_once(__DIR__."/../abstract/Manager.php");
require_once(__DIR__."/../entity/TVprogram.php");
require_once("ChannelManager.php");

class TVprogramManager extends Manager {//pattern CRUD : create, read, update, delete + methodes pratiques
    public function readAll($started) {
        $query = "SELECT * 
                    FROM TVprogram 
                    WHERE Begin ".($started ? '<= SUBTIME(CURTIME(), "00:02")' : '> CURTIME()');

        $request = parent::prepareAndExecute($query);

        foreach ($request->fetchAll(PDO::FETCH_ASSOC) as $line){
            $line['Channel'] = (new ChannelManager)->readById($line['ID_channel']);
            $result[] = new TVprogram($line);
        }

        return $result;
    }
}
