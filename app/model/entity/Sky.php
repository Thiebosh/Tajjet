<?php
require_once(__DIR__."/../abstract/Entity.php");

class Sky extends Entity {
    //attributes
    private $_label;

    private static $conversion = array("Clouds" => "Nuageux",
                                        "Rain" => "Pluvieux",
                                        "Clear" => "Dégagé");

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
    public function setID_Sky($id) {
        $this->setId($id);
    }

    public function setLabel($label) {
        if (is_string($label)) {
            $this->_label = isset(self::$conversion[$label]) ? self::$conversion[$label] : $label;
        }
    }
}