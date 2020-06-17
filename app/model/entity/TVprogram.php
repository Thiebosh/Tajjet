<?php
require_once(__DIR__."/../abstract/Entity.php");

require_once("Channel.php");

class TVprogram extends Entity {
    //attributes
    private $_title;
    private $_synopsis;
    private $_begin;
    private $_end;
    private $_genre; 

    private $_Channel;//objet Channel


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
        return $this->_title;
    }
    
    public function getSynopsis() {
        return $this->_synopsis;
    }
    
    public function getBegin() {
        return $this->_begin;
    }
    
    public function getEnd() {
        return $this->_end;
    }
    
    public function getGenre() {
        return $this->_genre;
    }

    public function getChannel() {
        return $this->_Channel  ;
    }

    //setters
    public function setTitle($title) {
        if (is_string($title)) $this->_title = $title;
    }
    
    public function setSynopsis($synopsis) {
        if (is_string($synopsis)) $this->_synopsis = $synopsis;
    }
    
    public function setBegin($begin) {
        if ($begin instanceof DateTime) $this->_begin = $begin;
        else if (isDateTimeConvertible($begin)) $this->_begin = new DateTime($begin);
    }
    
    public function setEnd($end) {
        if ($end instanceof DateTime) $this->_end = $end;
        else if (isDateTimeConvertible($end)) $this->_end = new DateTime($end);
    }

    public function setGenre($Genre) {
        if (is_string($genre)) $this->_genre = $genre;
    }

    public function setChannel($channel) {
        if ($channel instanceof Channel) $this->_Channe = $channel;
    }
}