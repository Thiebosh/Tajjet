<?php
require_once(__DIR__."/../abstract/Entity.php");

class Article extends Entity {
    //attributes
    private $_URL;
    private $_readingTime;
    private $_summary;


    //methods

    //constructor & destructor
    public function __construct(array $data) {
        //conversion de readingTime en objet DateTime si nécessaire?
        parent::__construct($data);
    }

    public function __destruct() {
        parent::__destruct();
    }


    //getters
    public function getURL() {
        return $this->_URL;
    }

    public function getReadingTime() {
        return $this->_readingTime;
    }

    public function getSummary() {
        return $this->_summary;
    }


    //setters
    public function setURL($url) {
        if (is_string($url)) $this->_URL = $url;
    }

    public function setReadingTime($readingTime) {
        if ($readingTime instanceof DateTime) $this->_readingTime = $readingTime;
        else if (isDateTimeConvertible($readingTime)) $this->_readingTime = new DateTime($readingTime);
    }

    public function setSummary($summary) {
        if (is_string($summary)) $this->_summary = $summary;
    }
}