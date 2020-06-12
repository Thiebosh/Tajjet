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
        //conversion de recordDate en objet DateTime si nécessaire?
        //conversion de sleep en objet DateTime si nécessaire?
        parent::__construct($data);
    }

    public function __destruct() {
        parent::__destruct();
    }


    //getters
    public function getRecordDate() {
        return this->_recordDate;
    }
    
    public function getWeight() {
        return this->_weight;
    }
    
    public function getCalories() {
        return this->_calories;
    }
    
    public function getSleep() {
        return this->_sleep;
    }
    
    public function getIdUser() {
        return this->_idUser;
    }


    //setters
    public function setLabel($label) {
        if (is_string($label)) this->_label = $label;
    }

    public function setRecordDate($recordDate) {
        if ($recordDate instanceof DateTime) this->_recordDate = $recordDate;
        else if (isDateTimeConvertible($recordDate)) this->_recordDate = new DateTime($recordDate);
    }
    
    public function setWeight($weight) {
        if (is_float($weight)) this->_weight = $weight;
    }
    
    public function setCalories($calories) {
        if (is_float($calories)) this->_calories = $calories;
    }
    
    public function setSleep($sleepTime) {
        if ($sleepTime instanceof DateTime) this->_sleep = $sleepTime;
        else if (isDateTimeConvertible($sleepTime)) this->_sleep = new DateTime($sleepTime);
    }
    
    public function setIdUser($idUser) {
        if (isID($idUser)) this->_idUser = $idUser;
    }
}