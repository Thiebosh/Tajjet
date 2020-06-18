<?php
require_once(__DIR__."/../abstract/Entity.php");

class Includ extends Entity {
    //attributes
    private $_quantity;
    private $_Recipe;//objet recipe
    private $_Item;//objet item

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

    public function getRecipe() {
        return $this->_Recipe;
    }

    public function getItem() {
        return $this->_Item;
    }

    //setters
    public function setQuantity($quantity) {
        $quantity = Entity::stringToFloat($quantity);
        if (is_float($quantity)) $this->_quantity = $quantity;
    }

    public function setRecipe($recipe) {
        if ($recipe instanceof Recipe) $this->_Recipe = $recipe;
    }

    public function setItem($item) {
        if ($item instanceof Item) $this->_Item = $item;
    }
}
