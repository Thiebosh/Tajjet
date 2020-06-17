<?php
require_once(__DIR__."/../abstract/Manager.php");
require_once(__DIR__."/../entity/User.php");

require_once("TownManager.php");

class UserManager extends Manager {//pattern CRUD : create, read, update, delete + methodes pratiques
    public function create($user) {
        $query = 'INSERT INTO User(Name, Password, Avatar, BirthDate, Height'.($user->getID_Town() != null ? ', ID_town' : '').')
                    VALUES(:name, :password, :avatar, :birthDate, :height'.($user->getID_Town() != null ? ', :town' : '').')';
        $table = array('name'       => $user->getName(),
                        'password'  => $user->getPassword(),
                        'avatar'    => ($user->getAvatar()      != null) ? $user->getAvatar()                       : PDO::PARAM_NULL,
                        'birthDate' => ($user->getBirthDate()   != null) ? Entity::printDate($user->getBirthDate()) : PDO::PARAM_NULL,
                        'height'    => ($user->getHeight()      != null) ? $user->getHeight()                       : PDO::PARAM_NULL);
        if ($user->getID_Town() != null) $table['town'] = $user->getID_Town();

        $request = parent::getDBConnect()->prepare($query);
        if (!$request->execute($table)) throw new Exception("Base De Données : Echec d'exécution");

        return $this->readByName($user->getName());//ajoute id
    }


    public function readByName($name) {
        $result = $this->isUsedName($name);

        if ($result !== false) {
            $result = new User($result);
            $result->setTown((new TownManager)->readById($result->getID_Town()));
        }

        return $result;
    }


    public function isUsedName($name) {
        $query = 'SELECT *
                    FROM User 
                    WHERE Name = :name';
        $table = array('name' => $name);
        
        $request = parent::getDBConnect()->prepare($query);
        if (!$request->execute($table)) throw new Exception("Base De Données : Echec d'exécution");

        $result = $request->fetchAll(PDO::FETCH_ASSOC);//fetchAll => close cursor implicite

        return (count($result) != 0) ? $result[0] : false;//fetchAll => tableau => indice 0
    }
    

    public function update($user) {//a tester
        $query = 'UPDATE User
                    SET Name = :name, 
                        Password = :password, 
                        Avatar = :avatar,
                        BirthDate = :birthDate, 
                        Height = :height
                        '.($user->getID_Town() != null ? ', ID_town = :town' : '').'
                    WHERE ID_user = :idUser';
        $table = array('idUser'     => $user->getId(),
                        'name'      => $user->getName(),
                        'password'  => $user->getPassword(),
                        'avatar'    => ($user->getAvatar()      != null) ? $user->getAvatar()                       : PDO::PARAM_NULL,
                        'birthDate' => ($user->getBirthDate()   != null) ? Entity::printDate($user->getBirthDate()) : PDO::PARAM_NULL,
                        'height'    => ($user->getHeight()      != null) ? $user->getHeight()                       : PDO::PARAM_NULL);

        var_dump($table);
        if ($user->getID_Town() != null) $table['town'] = $user->getID_Town();

        $request = parent::getDBConnect()->prepare($query);
        if (!$request->execute($table)) throw new Exception("Base De Données : Echec d'exécution");
    }
}