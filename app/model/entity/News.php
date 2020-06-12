<?php
require_once(__DIR__."/../abstract/Entity.php");

require_once("Article.php");
require_once("Theme.php");

class News extends Entity {
    //attributes
    private $_summary;
    private $_Theme;//instance de Theme
    //private $_Articles;//tableau d'instances d'Articles


    //methods

    //constructor & destructor
    public function __construct(array $data) {
        parent::__construct($data);
    }

    public function __destruct() {
        parent::__destruct();
    }


    //getters
    public function getSummary() {
        return this->_summary;
    }

    public function getTheme() {
        return this->_Theme;
    }
    

    //setters
    public function setSummary($summary) {
        if (is_string($summary)) this->_summary = $summary;
    }

    public function setTheme($theme) {
        if ($theme instanceof Theme) this->_Theme = $theme;
    }
}