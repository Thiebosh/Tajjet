<?php
require_once(__DIR__."/../abstract/Entity.php");

require_once("Sport.php");
require_once("Item.php");

class Genre extends Entity {
    //attributes
    private $_name;
    private $_password;
    private $_avatar;
    private $_birthDate;
    private $_height;
    private $_idTown;

    private $_Sports;//liste d'instances de Sport (programme)
    private $_Items;//liste d'instances de Item (courses)


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

    public function getPassword() {
        return $this->_password;
    }

    public function getAvatar() {
        return $this->_avatar;
    }
    
    public function getBirthDate() {
        return $this->_birthDate;
    }

    public function getHeight() {
        return $this->_height;
    }

    public function getIdTown() {
        return $this->_idTown;
    }

    public function getSports() {
        return $this->_Sports;
    }

    public function getItems() {
        return $this->_Items;
    }


    //setters
    public function setName($name) {
        if (is_string($name)) $this->_name = $name;
    }

    public function setPassword($password) {
        if (is_string($password)) $this->_password = $password;
    }

    public function setAvatar($avatar) {
        if (is_string($avatar)) $this->_avatar = $avatar;
    }
    
    public function setBirthDate($birthDate) {
        if ($birthDate instanceof DateTime) $this->_birthDate = $birthDate;
        else if (isDateTimeConvertible($birthDate)) $this->_birthDate = new DateTime($birthDate);
    }

    public function setHeight($height) {
        if (is_float($height)) $this->_height = $height;
    }

    public function setIdTown($idTown) {
        if (isID($idTown)) $this->_idTown = $idTown;
    }

    public function setSports($sports) {
        unset($this->_Sports);
        foreach ($sports as $sport) addSport($sport);
    }

    public function addSport($sport) {
        if ($sport instanceof Sport) $this->_Sports[] = $sport;
    }

    public function setItems($items) {
        unset($this->_Items);
        foreach ($items as $item) addSport($item);
    }

    public function addItem($item) {
        if ($item instanceof Item) $this->_Items[] = $item;
    }
}