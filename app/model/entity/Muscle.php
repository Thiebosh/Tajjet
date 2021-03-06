<?php
require_once(__DIR__."/../abstract/Entity.php");

class Muscle extends Entity {
    //attributes
    private $_label;


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
        return $this->_label;
    }


    //setters
    public function setID_muscle($id) {
        $this->setId($id);
    }

    public function setLabel($label) {
        if (is_string($label)) $this->_label = $label;
    }
}