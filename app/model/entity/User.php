<?php
require_once(__DIR__."/../abstract/Entity.php");

require_once("Sport.php");
require_once("Town.php");

class User extends Entity {
    //attributes
    private $_name;
    private $_password;
    private $_birthDate = null;
    private $_height = null;
    private $_idTown = null;

    private $_Town;//instance de Town
    private $_Sports;//liste d'instances de Sport (programme)


    //methods

    //constructor & destructor
    public function __construct(array $data) {
        parent::__construct($data);
    }

    public function __destruct() {
        parent::__destruct();
    }

    public function objectToJson() {
        return json_encode(get_object_vars($this));
    }

    //getters
    public function getName() {
        return $this->_name;
    }

    public function getPassword() {
        return $this->_password;
    }
    
    public function getBirthDate() {
        return $this->_birthDate;
    }

    public function getHeight() {
        return $this->_height;
    }

    public function getID_Town() {
        return $this->_idTown;
    }

    public function getTown() {
        return ($this->_Town != null) ? $this->_Town : new Town(array());
    }

    public function getSports() {
        return $this->_Sports;
    }


    //setters
    public function setID_user($id) {
        $this->setId($id);
    }

    public function setName($name) {
        if (is_string($name)) $this->_name = $name;
    }

    public function setPassword($password) {
        if (is_string($password)) $this->_password = $password;
    }
    
    public function setBirthDate($birthDate) {
        if (is_string($birthDate)) $this->_birthDate = $birthDate;
    }

    public function setHeight($height) {
        $height = Entity::stringToFloat($height);
        if (is_float($height)) $this->_height = $height;
    }

    public function setID_town($idTown) {
        $this->_idTown = Entity::stringToFloat($idTown);
    }

    public function setTown($town) {
        if ($town instanceof Town) {
            $this->_Town = $town;
            $this->_idTown = $this->_Town->getId();
        }
    }

    public function setSports($sports) {
        unset($this->_Sports);
        foreach ($sports as $sport) addSport($sport);
    }

    public function addSport($sport) {
        if ($sport instanceof Sport) $this->_Sports[] = $sport;
    }
}