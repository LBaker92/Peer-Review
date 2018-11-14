<?php

abstract class DatabaseUser {

    abstract public function getId();
    abstract public function getFirstName();
    abstract public function getLastName();
    abstract public function getUsername();
    abstract public function getEmail();
    abstract public function getPassword();

    abstract public function setId($id);
    abstract public function setFirstName($first_name);
    abstract public function setLastName($last_name);
    abstract public function setUsername($username);
    abstract public function setEmail($email);
    abstract public function setPassword($password);
    
}


?>