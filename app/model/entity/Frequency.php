<?php
require_once(__DIR__."/../abstract/Entity.php");

class Frequency extends Entity {
    //attributes
    private $_numberOfDays;
    private $_nextDate;


    //methods

    //constructor & destructor
    public function __construct(array $data) {
        //conversion de nextDate en objet DateTime si nécessaire?
        parent::__construct($data);
    }

    public function __destruct() {
        parent::__destruct();
    }


    //getters
    public function getNumberOfDays() {
        return this->_numberOfDays;
    }

    public function etNextDate() {
        return this->_nextDate;
    }


    //setters
    public function setNumberOfDays($numberOfDays) {
        if (is_float($numberOfDays)) this->_numberOfDays = $numberOfDays;
    }

    public function setNextDate($nextDate) {
        if ($nextDate instanceof DateTime) this->_nextDate = $nextDate;
    }
}