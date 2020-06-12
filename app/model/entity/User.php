<?php
require_once(__DIR__."/../abstract/Entity.php");

require_once("Sport.php");
require_once("Item.php");

class Genre extends Entity {
    //attributes
    private $_login;
    private $_pasword;
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
    public function getLogin() {
        return this->_login;
    }

    public function getPasword() {
        return this->_pasword;
    }

    public function getAvatar() {
        return this->_avatar;
    }
    
    public function getBirthDate() {
        return this->_birthDate;
    }

    public function getHeight() {
        return this->_height;
    }

    public function getIdTown() {
        return this->_idTown;
    }

    public function getSports() {
        return this->_Sports;
    }

    public function getItems() {
        return this->_Items;
    }


    //setters
    public function setLogin($login) {
        if (is_string($login)) this->_login = $login;
    }

    public function setPasword($pasword) {
        if (is_string($pasword)) this->_pasword = $pasword;
    }

    public function setAvatar($avatar) {
        if (is_string($avatar)) this->_avatar = $avatar;
    }
    
    public function setBirthDate($birthDate) {
        if ($birthDate instanceof DateTime) this->_birthDate = $birthDate;
        else if (isDateTimeConvertible($birthDate)) this->_birthDate = new DateTime($birthDate);
    }

    public function setHeight($height) {
        if (is_float($height)) this->_height = $height;
    }

    public function setIdTown($idTown) {
        if (isID($idTown)) this->_idTown = $idTown;
    }

    public function setSports($sports) {
        unset(this->_Sports);
        foreach ($sports as $sport) addSport($sport);
    }

    public function addSport($sport) {
        if ($sport instanceof Sport) this->_Sports[] = $sport;
    }

    public function setItems($items) {
        unset(this->_Items);
        foreach ($items as $item) addSport($item);
    }

    public function addItem($item) {
        if ($item instanceof Item) this->_Items[] = $item;
    }
}