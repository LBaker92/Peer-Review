<?php

class User {
    private $id;
    private $email;
    private $password;
    private $role;

    public __construct($result) {
        $this->$id = $result["id"];
        $this->$email = $result["email"];
        $this->$password = $result["password"];
        $this->$role = $result["role"];
    }

    public function get_id() { return $this->id }
    public function get_email() { return $this->email }
    public function get_password() { return $this->password }
    public function get_role() { return $this->role }

?>