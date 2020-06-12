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
        return this->_id;
    }

    //setters
    public function setId($id) {
        if (isID($id)) this->_id = $id;
    }

    //methods
    final protected function hydrate(array $data) {
        foreach ($data as $key => $value) {
            $method = 'set'.ucfirst($key);

            if (method_exists($this, $method)) $this->$method($value);
        }
    }

    final function isID($value) {
        return is_int($value) && $value > 0;
    }

    final function isDateTimeConvertible($value) {
        return is_string($preparationTime) && strtotime($preparationTime);
    }

    static function printDate($date) {
        return $date instanceof DateTime ? $date->format('d-m-Y') : NULL ;
    }

    static function printTime($time) {
        return $time instanceof DateTime ? $time->format('H:i') : NULL ;
    }

    static function printDateTime($datetime) {
        return printTime($datetime)+' '+printDate($datetime);
    }
}