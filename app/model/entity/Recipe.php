<?php
require_once(__DIR__."/../abstract/Entity.php");

require_once("Item.php");

class Recipe extends Entity {
    //attributes
    private $_label;
    private $_picture;
    private $_preparationTime;
    private $_cookingTime;
    private $_steps;
    private $_calories;

    private $_Items;//liste d'instances de Item (courses)


    //methods

    //constructor & destructor
    public function __construct(array $data) {
        //verif preptime et cooktime bien datetime?
        parent::__construct($data);
    }

    public function __destruct() {
        parent::__destruct();
    }


    //getters
    public function getLabel() {
        return $this->_label;
    }
    
    public function getPicture() {
        return $this->_picture;
    }
    
    public function getPreparationTime() {
        return $this->_preparationTime;
    }
    
    public function getCookingTime() {
        return $this->_cookingTime;
    }
    
    public function getSteps() {
        return $this->_steps;
    }
    
    public function getCalories() {
        return $this->_calories;
    }

    public function getItems() {
        return $this->_Items;
    }


    //setters
    public function setLabel($label) {
        if (is_string($label)) $this->_label = $label;
    }

    public function setPicture($picture) {
        if (is_string($picture)) $this->_picture = $picture;
    }
    
    public function setPreparationTime($preparationTime) {
        if ($preparationTime instanceof DateTime) $this->_preparationTime = $preparationTime;
        else if (isDateTimeConvertible($preparationTime)) $this->_preparationTime = new DateTime($preparationTime);
    }
    
    public function setCookingTime($cookingTime) {
        if ($cookingTime instanceof DateTime) $this->_cookingTime = $cookingTime;
        else if (isDateTimeConvertible($cookingTime)) $this->_cookingTime = new DateTime($cookingTime);
    }
    
    public function setSteps($steps) {
        if (is_string($steps)) $this->_steps = $steps;
    }
    
    public function setCalories($calories) {
        if (is_float($calories)) $this->_calories = $calories;
    }

    public function setItems($items) {
        unset($this->_Items);
        foreach ($items as $item) addSport($item);
    }

    public function addItem($item) {
        if ($item instanceof Item) $this->_Items[] = $item;
    }
}