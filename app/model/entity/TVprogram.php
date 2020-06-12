<?php
require_once(__DIR__."/../abstract/Entity.php");

class News extends Entity {
    //attributes
    private $_title;
    private $_synopsis;
    private $_begin;
    private $_end;
    
    private $_Genres; //array of Genre instances


    //methods

    //constructor & destructor
    public function __construct(array $data) {
        //conversion de begin en objet DateTime si nécessaire?
        //conversion de end en objet DateTime si nécessaire?
        parent::__construct($data);
    }

    public function __destruct() {
        parent::__destruct();
    }


    //getters
    public function getTitle() {
        return this->_title;
    }
    
    public function getSynopsis() {
        return this->_synopsis;
    }
    
    public function getBegin() {
        return this->_begin;
    }
    
    public function getEnd() {
        return this->_end;
    }
    
    public function getGenres() {
        return this->_Genres;
    }


    //setters
    public function setTitle($title) {
        if (is_string($title)) this->_title = $title;
    }
    
    public function setSynopsis($synopsis) {
        if (is_string($synopsis)) this->_synopsis = $synopsis;
    }
    
    public function setBegin($begin) {
        if ($begin instanceof DateTime) this->_begin = $begin;
    }
    
    public function setEnd($end) {
        if ($end instanceof DateTime) this->_end = $end;
    }

    public function setGenres($genres) {
        foreach ($genres as $genre) addGenre($genre);
    }

    public function addGenre($genre) {
        if ($genre instanceof Genre) this->_Genres[] = $genre;
    }
}