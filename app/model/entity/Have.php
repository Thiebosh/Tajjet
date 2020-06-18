<?php
require_once(__DIR__."/../abstract/Entity.php");

class Have extends Entity {
    //attributes
    private $_quantity;
    private $_Item;//objet item
    private $_User;//objet user
    

    //methods

    //constructor & destructor
    public function __construct(array $data) {
        parent::__construct($data);
    }

    public function __destruct() {
        parent::__destruct();
    }


    //getters
    public function getQuantity() {
        return $this->_quantity;
    }

    public function getItem() {
        return $this->_Item;
    }

    public function getUser() {
        return $this->_User;
    }


    //setters
    public function setQuantity($quantity) {
        $quantity = Entity::stringToFloat($quantity);
        if (is_float($quantity)) $this->_quantity = $quantity;
    }

    public function setItem($item) {
        if ($item instanceof Item) $this->_Item = $item;
    }

    public function setUser($user) {
        if ($user instanceof User) $this->_User = $user;
    }

    
}
