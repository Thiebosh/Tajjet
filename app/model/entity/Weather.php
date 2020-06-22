<?php
require_once(__DIR__."/../abstract/Entity.php");

require_once("Sky.php");

class Weather extends Entity {
    //attributes
    private $_forecast;
    private $_temp;
    private $_feltTemp;
    private $_humidity;
    private $_pressure;
    private $_Sky;//objet sky
    private $_Town;//objet town


    //methods

    //constructor & destructor
    public function __construct(array $data) {
        parent::__construct($data);
    }

    public function __destruct() {
        parent::__destruct();
    }


    //getters
    public function getForecast() {
        return $this->_forecast;
    }

    public function getTemp() {
        return $this->_temp;
    }

    public function getFeltTemp() {
        return $this->_feltTemp;
    }

    public function getHumidity() {
        return $this->_humidity;
    }

    public function getPressure() {
        return $this->_pressure;
    }

    public function getSky() {
        return $this->_Sky;
    }

    public function getTown() {
        return $this->_Town;
    }


    //setters
    public function setID_weather($id) {
        $this->setId($id);
    }
    
    public function setForecast($forecast) {
        if (is_string($forecast)) $this->_forecast = $forecast;
    }

    public function setTemp($temp) {
        $temp = Entity::stringToFloat($temp);
        if (is_float($temp)) $this->_temp = $temp;
    }

    public function setFeltTemp($temp) {
        $temp = Entity::stringToFloat($temp);
        if (is_float($temp)) $this->_feltTemp = $temp;
    }

    public function setHumidity($humidity) {
        $humidity = Entity::stringToFloat($humidity);
        if (is_float($humidity) && $humidity >= 0 && $humidity <= 100) $this->_humidity = $humidity;
    }

    public function setPressure($pressure) {
        $pressure = Entity::stringToFloat($pressure);
        if (is_float($pressure) && $pressure >= 0) $this->_pressure = $pressure;
    }

    public function setSky($sky) {
        if ($sky instanceof Sky) $this->_Sky = $sky;
    }

    public function setTown($town) {
        if ($town instanceof Town) $this->_Town = $town;
    }
}