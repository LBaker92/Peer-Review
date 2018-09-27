<?php

class User {

    private $id;
    private $email;
    private $password;
    private $role;

    function __construct($result) {
        $this->id = $result["user_id"];
        $this->email = $result["user_email"];
        $this->password = $result["user_password"];
        $this->role = $result["user_role"];
    }

    public function getId() { return $this->id; }
    public function getEmail() { return $this->email; }
    public function getPassword() { return $this->password; }
    public function getRole() { return $this->role; }

    public function setId($id) {  $this->id = $id; }
    public function setEmail($email) {  $this->email = $email; }
    public function setPassword($password) {  $this->password = $password; }
    public function setRole($role) {  $this->role = $role; }
}

?>