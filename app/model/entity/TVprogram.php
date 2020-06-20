<?php
require_once(__DIR__."/../abstract/Entity.php");

require_once("Channel.php");

class TVprogram extends Entity {
    //attributes
    protected  $_title;
    protected  $_synopsis;
    protected  $_begin;
    protected  $_genre; 

    protected  $_Channel;//objet Channel


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
        $tmp->_Channel = ($tmp->_Channel)->objectToJson();
        $tmp->_synopsis = \ForceUTF8\Encoding::toUTF8($tmp->_synopsis);
        $tmp->_title = \ForceUTF8\Encoding::toUTF8($tmp->_title);
        $tmp->_genre = \ForceUTF8\Encoding::toUTF8($tmp->_genre);
        return json_encode(get_object_vars($tmp));
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
    
    public function getGenre() {
        return $this->_genre;
    }

    public function getChannel() {
        return $this->_Channel  ;
    }

    //setters
    public function setID_TVprogram($id) {
        $this->setId($id);
    }

    public function setTitle($title) {
        if (is_string($title)) $this->_title = $title;
    }
    
    public function setSynopsis($synopsis) {
        if (is_string($synopsis)) $this->_synopsis = $synopsis;
    }
    
    public function setBegin($begin) {
        if (is_string($begin)) $this->_begin = $begin;
    }

    public function setGenre($genre) {
        if (is_string($genre)) $this->_genre = $genre;
    }

    public function setChannel($channel) {
        if ($channel instanceof Channel) $this->_Channel = $channel;
    }
}