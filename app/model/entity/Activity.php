<?php
require_once(__DIR__."/../abstract/Entity.php");

class Activity extends Entity {
    //attributes
    private $_label;
    private $_distance;
    private $_idTown;
    private $_idCategory;


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

    public function getDistance() {
        return $this->_distance;
    }

    public function getIdTown() {
        return $this->_idTown;
    }

    public function getIdCategory() {
        return $this->_idCategory;
    }


    //setters
    public function setLabel($label) {
        if (is_string($label)) $this->_label = $label;
    }

    public function setDistance($distance) {
        if (is_float($distance)) $this->_distance = $distance;
    }

    public function setIdTown($id) {
        if (isID($id)) $this->_idTown = $id;
    }

    public function setIdCategory$id) {
        if (isID($id)) $this->_idCategory = $id;
    }
}