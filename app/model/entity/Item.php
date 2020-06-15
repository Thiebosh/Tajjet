<?php
require_once(__DIR__."/../abstract/Entity.php");

class Item extends Entity {
    //attributes
    private $_label;
    private $_consumable;


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

    public function getConsumable() {
        return $this->_consumable;
    }


    //setters
    public function setLabel($label) {
        if (is_string($label)) $this->_label = $label;
    }

    public function setConsumable($consumable) {
        if (is_bool($consumable)) $this->_consumable = $consumable;
    }
}