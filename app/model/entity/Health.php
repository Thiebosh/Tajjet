<?php
require_once(__DIR__."/../abstract/Entity.php");

class Health extends Entity {
    //attributes
    private $_recordDate;
    private $_weight;
    private $_calories;
    private $_sleep;
    private $_idUser;


    //methods

    //constructor & destructor
    public function __construct(array $data) {
        parent::__construct($data);
    }

    public function __destruct() {
        parent::__destruct();
    }


    //getters
    public function getRecordDate() {
        return $this->_recordDate;
    }
    
    public function getWeight() {
        return $this->_weight;
    }
    
    public function getCalories() {
        return $this->_calories;
    }
    
    public function getSleep() {
        return $this->_sleep;
    }
    
    public function getIdUser() {
        return $this->_idUser;
    }


    //setters
    public function setRecordDate($recordDate) {
        if (is_string($recordDate)) $this->_recordDate = $recordDate;
    }
    
    public function setWeight($weight) {
        $weight = Entity::stringToFloat($weight);
        if (is_float($weight)) $this->_weight = $weight;
    }
    
    public function setCalories($calories) {
        $calories = Entity::stringToFloat($calories);
        if (is_float($calories)) $this->_calories = $calories;
    }
    
    public function setSleep($sleepTime) {
        if (is_string($sleepTime)) $this->_sleep = $sleepTime;
    }
    
    public function setIdUser($idUser) {
        if (isID($idUser)) $this->_idUser = $idUser;
    }
}