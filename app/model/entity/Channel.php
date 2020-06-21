<?php
require_once(__DIR__."/../abstract/Entity.php");

class Channel extends Entity {
    //attributes
    protected  $_label;


    //methods

    //constructor & destructor
    public function __construct(array $data) {
        parent::__construct($data);
    }

    public function __destruct() {
        parent::__destruct();
    }

    public function objectToJson() {
        $tmp = $this;
        $tmp->_label = \ForceUTF8\Encoding::toUTF8($tmp->_label);
        return json_encode(get_object_vars($tmp));
    }

    //getters
    public function getLabel() {
        return $this->_label;
    }


    //setters
    public function setID_Channel($id) {
        $this->setId($id);
    }

    public function setLabel($label) {
        if (is_string($label)) $this->_label = $label;
    }
}