<?php
require_once(__DIR__."/../abstract/Manager.php");
require_once(__DIR__."/../entity/User.php");

class UserManager extends Manager {
    public function isUsedName($name) {//fonctionne
        $query = 'SELECT *
                    FROM User 
                    WHERE Name = :name';
        $table = array('name' => $name);
        
        $request = parent::getDBConnect()->prepare($query);
        if (!$request->execute($table)) throw new Exception("Base De Données : Echec d'exécution");

        $result = $request->fetchAll(PDO::FETCH_ASSOC);//fetchAll => close cursor implicite

        return (count($result) != 0) ? $result[0] : false;//fetchAll => tableau => indice 0
    }
    
    
    public function getUserByName($name) {//fonctionne
        $result = $this->isUsedName($name);

        return ($result === false) ? false : new User($result);
    }


    public function addUser($user) {//fonctionne
        $query = 'INSERT INTO User(Name, Password, Avatar, BirthDate, Height'.($user->getID_Town() != null ? ', ID_town' : '').')
                    VALUES(:name, :password, :avatar, :birthDate, :height'.($user->getID_Town() != null ? ', :town' : '').')';
        $table = array('name'       => $user->getName(),
                        'password'  => $user->getPassword(),
                        'avatar'    => ($user->getAvatar()      != null) ? $user->getAvatar()       : PDO::PARAM_NULL,
                        'birthDate' => ($user->getBirthDate()   != null) ? $user->getBirthDate()    : PDO::PARAM_NULL,
                        'height'    => ($user->getHeight()      != null) ? $user->getHeight()       : PDO::PARAM_NULL);
        if ($user->getID_Town() != null) $table['town'] = $user->getID_Town();

        $request = parent::getDBConnect()->prepare($query);
        if (!$request->execute($table)) throw new Exception("Base De Données : Echec d'exécution");

        return $this->getUserByName($user->getName());//ajoute id
    }
}