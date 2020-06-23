<?php
require_once(__DIR__."/../abstract/Entity.php");

class Type extends Entity {
    //attributes
    private $_label;

    private static $conversion = array("entree" => "Entrée",
                                        "plat principal" => "Plat principal",
                                        "dessert" => "Dessert");

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

    public function getDBLabel() {
        return array_flip(self::$conversionBoolString)[$this->_label];
    }


    //setters
    public function setID_type($id) {
        $this->setId($id);
    }

    public function setLabel($label) {
        if (is_string($label)) {
            $this->_label = isset(self::$conversion[$label]) ? self::$conversion[$label] : $label;
        }
    }
}