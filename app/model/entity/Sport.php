<?php
require_once(__DIR__."/../abstract/Entity.php");

require_once("Muscle.php");

class Sport extends Entity {
    //attributes
    private $_label;
    private $_picture;
    private $_calories;

    private $_Muscles; //array of Muscle instances


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
        return this->_label;
    }
    
    public function getPicture() {
        return this->_picture;
    }
    
    public function getCalories() {
        return this->_calories;
    }
    
    public function getMuscles() {
        return this->_Muscles;
    }


    //setters
    public function setLabel($label) {
        if (is_string($label)) this->_label = $label;
    }
    
    public function setPicture($picture) {
        if (is_string($picture)) this->_picture = $picture;
    }
    
    public function setCalories($calories) {
        if (is_float($calories)) this->_calories = $calories;
    }

    public function setMuscles($muscles) {
        unset(this->_Muscles);
        foreach ($muscles as $muscle) addMuscle($muscle);
    }

    public function addMuscle($muscle) {
        if ($muscle instanceof Muscle) this->_Muscles[] = $muscle;
    }
}