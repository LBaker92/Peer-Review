<?php

class Instructor extends DatabaseUser {
    
    private $id = null;
    private $first_name;
    private $last_name;
    private $username;
    private $email;
    private $password;

    function __construct($result = array()) {
        $this->id = $result["id"];
        $this->first_name = $result["first_name"];
        $this->last_name = $result["last_name"];
        $this->username = $result["username"];
        $this->email = $result["email"];
        $this->password = $result["password"];
    }

    public function getId() { return $this->id; }
    public function getFirstName() { return $this->first_name; }
    public function getLastName() { return $this->last_name; }
    public function getUsername() { return $this->username; }
    public function getEmail() { return $this->email; }
    public function getPassword() { return $this->password; }

    public function setId($id) {  $this->id = $id; }
    public function setFirstName($first_name) { $this->first_name = $first_name; }
    public function setLastName($last_name) { $this->last_name = $last_name; }
    public function setUsername($username) { $this->username = $username; }
    public function setEmail($email) {  $this->email = $email; }
    public function setPassword($password) {  $this->password = $password; }

}

?>