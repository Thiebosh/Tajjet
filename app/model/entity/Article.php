<?php
require_once(__DIR__."/../abstract/Entity.php");

class Article extends Entity {
    //attributes
    private $_titre;
    private $_URL;
    private $_readingTime;
    private $_summary;


    //methods

    //constructor & destructor
    public function __construct(array $data) {
        parent::__construct($data);
    }

    public function __destruct() {
        parent::__destruct();
    }


    //getters
    public function getTitre() {
        return $this->_titre;
    }

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
    public function setID_article($id) {
        $this->setId($id);
    }
    
    public function setTitre($titre) {
        if (is_string($titre)) $this->_titre = $titre;
    }

    public function setURL($url) {
        if (is_string($url)) $this->_URL = $url;
    }

    public function setReadingTime($readingTime) {
        if (is_string($readingTime)) $this->_readingTime = $readingTime;
    }

    public function setSummary($summary) {
        if (is_string($summary)) $this->_summary = $summary;
    }
}