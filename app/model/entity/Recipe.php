<?php
require_once(__DIR__."/../abstract/Entity.php");

class Recipe extends Entity {
    //attributes
    private $_name;
    private $_picture;
    private $_nbPerson;
    private $_preparationTime;
    private $_cookingTime;
    private $_totalTime;
    private $_score;
    private $_price;
    private $_difficulty;
    private $_steps;
    private $_calories;
    private $_ingredients;


    //methods

    //constructor & destructor
    public function __construct(array $data) {
        parent::__construct($data);
    }

    public function __destruct() {
        parent::__destruct();
    }


    //getters
    public function getName() {
        return $this->_name;
    }
    
    public function getPicture() {
        return $this->_picture;
    }
    
    public function getNbPerson() {
        return $this->_nbPerson;
    }

    public function getPreparationTime() {
        return $this->_preparationTime;
    }
    
    public function getCookingTime() {
        return $this->_cookingTime;
    }
    public function getTotalTime() {
        return $this->_totalTime;
    }
    public function getScore() {
        return $this->_score;
    }
    public function getPrice() {
        return $this->_price;
    }
    public function getDifficulty() {
        return $this->_difficulty;
    }
    
    public function getSteps() {
        return $this->_steps;
    }
    
    public function getCalories() {
        return $this->_calories;
    }

    public function getIngredients() {
        return $this->_ingredients;
    }


    //setters
    public function setID_recipe($id) {
        $this->setId($id);
    }

    public function setName($name) {
        if (is_string($name)) $this->_name = $name;
    }

    public function setPicture($picture) {
        if (is_string($picture)) $this->_picture = $picture;
    }

    public function setNbPerson($nbPerson) {
        if (is_string($nbPerson)) $this->_nbPerson   = $nbPerson;
    }
    
    public function setPreparationTime($preparationTime) {
        if (is_string($preparationTime)) $this->_preparationTime = $preparationTime;
    }
    
    public function setCookingTime($cookingTime) {
        if (is_string($cookingTime)) $this->_cookingTime = $cookingTime;
    }
    public function setTotalTime($totalTime) {
        if (is_string($totalTime)) $this->_totalTime = $totalTime;
    }
    
    public function setScore($score) {
        $score = Entity::stringToFloat($score);
        if (is_float($score)) $this->_score = $score;
    }
    public function setPrice($price) {
        if (is_string($price)) $this->_price = $price;
    }
    public function setDifficulty($difficulty) {
        if (is_string($difficulty)) $this->_difficulty = $difficulty;
    }
    public function setSteps($steps) {
        if (is_string($steps)) $this->_steps = $steps;
    }
    
    public function setCalories($calories) {
        $calories = Entity::stringToFloat($calories);
        if (is_float($calories)) $this->_calories = $calories;
    }

    public function setIngredients($items) {
        if (is_string($items)) $this->_ingredients = $items;
    }
}