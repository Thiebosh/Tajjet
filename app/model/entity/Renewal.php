<?php
require_once(__DIR__."/../abstract/Entity.php");

class Renewal extends Entity {
    //attributes
    private $_moduleName;
    private $_idFrequency;


    //methods

    //constructor & destructor
    public function __construct(array $data) {
        parent::__construct($data);
    }

    public function __destruct() {
        parent::__destruct();
    }


    //getters
    public function getModuleName() {
        return $this->_moduleName;
    }

    public function getIdFrequency() {
        return $this->_idFrequency;
    }


    //setters
    public function setModuleName($moduleName) {
        if (is_string($moduleName)) $this->_moduleName = $moduleName;
    }

    public function setIdFrequency($idFrequency) {
        if (isID($idFrequency)) $this->_idFrequency = $idFrequency;
    }
}