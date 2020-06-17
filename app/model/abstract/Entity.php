<?php

abstract class Entity {
    //attributes
    private $_id;

    //construct & destruct
    public function __construct(array $data) {
        $this->hydrate($data);
    }

    public function __destruct() {
        //if needed
    }

    
    //getters
    public function getId() {
        return $this->_id;
    }

    //setters
    public function setId($id) {
        $id = intval($id);
        if ($this->isID($id)) $this->_id = $id;
    }

    //methods
    protected final function hydrate(array $data) {
        foreach ($data as $key => $value) {
            $method = 'set'.ucfirst($key);

            if (method_exists($this, $method)) $this->$method($value);
        }
    }

    protected final function isID($value) {
        return is_int($value) && $value > 0;
    }

    protected final function isDateTimeConvertible($value) {
        return is_string($value) && strtotime($value);
    }

    public static function stringToFloat($number) {
        $number = str_replace(',','.',$number);
        return (is_numeric($number)) ? floatval($number) : null;
    }

    public static function printDate($date) {
        return $date instanceof DateTime ? $date->format('d-m-Y') : NULL ;
    }

    public static function printTime($time) {
        return $time instanceof DateTime ? $time->format('H:i') : NULL ;
    }

    public static function printDateTime($datetime) {
        return printTime($datetime)+' '+printDate($datetime);
    }
}