<?php
require_once(__DIR__."/../abstract/Entity.php");

require_once("Sky.php");

class Town extends Entity {
    //attributes
    private $_label;
    private $_minTemp;
    private $_maxTemp;
    private $_feltTemp;
    private $_humidity;
    private $_pressure;
    private $_Sky;//objet sky


    //methods

    //constructor & destructor
    public function __construct(array $data) {
        parent::__construct($data);
    }

    public function __destruct() {
        parent::__destruct();
    }


    //getters
    public function getLabel() {
        return this->_label;
    }

    public function getMinTemp() {
        return this->_minTemp;
    }

    public function getMaxTemp() {
        return this->_maxTemp;
    }

    public function getFeltTemp() {
        return this->_feltTemp;
    }

    public function getHumidity() {
        return this->_humidity;
    }

    public function getPressure() {
        return this->_pressure;
    }

    public function getSky() {
        return this->_Sky;
    }


    //setters
    public function setLabel($label) {
        if (is_string($label)) this->_label = $label;
    }

    public function setMinTemp($temp) {
        if (is_float($temp)) this->_minTemp = $temp;
    }

    public function setMaxTemp($temp) {
        if (is_float($temp)) this->_maxTemp = $temp;
    }

    public function setFeltTemp($temp) {
        if (is_float($temp)) this->_feltTemp = $temp;
    }

    public function setHumidity($humidity) {
        if (is_float($humidity) && $humidity >= 0 && $humidity <= 100) this->_humidity = $humidity;
    }

    public function setPressure($pressure) {
        if (is_float($pressure) && $pressure >= 0) this->_pressure = $pressure;
    }

    public function setSky($sky) {
        if ($sky instanceof Sky) this->_Sky = $sky;
    }
}