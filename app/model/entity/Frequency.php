<?php
require_once(__DIR__."/../abstract/Entity.php");

class Frequency extends Entity {
    //attributes
    private $_numberOfDays;
    private $_nextDate;


    //methods

    //constructor & destructor
    public function __construct(array $data) {
        parent::__construct($data);
    }

    public function __destruct() {
        parent::__destruct();
    }


    //getters
    public function getNumberOfDays() {
        return $this->_numberOfDays;
    }

    public function getNextDate() {
        return $this->_nextDate;
    }


    //setters
    public function setNumberOfDays($numberOfDays) {
        $numberOfDays = Entity::stringToFloat($numberOfDays);
        if (is_float($numberOfDays) && $numberOfDays > 0) $this->_numberOfDays = $numberOfDays;
    }

    public function setNextDate($nextDate) {
        if (is_string($nextDate)) $this->_nextDate = $nextDate;
    }
}