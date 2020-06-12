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
}