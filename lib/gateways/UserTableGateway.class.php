<?php

include_once '../lib/db/DBQueryRunner.class.php';
include_once 'User.class.php';

class UserTableGateway {

    private static $baseSql = "Select * from users";

    public function __construct() { }

    public function findAll() {
        $statement = DBQueryRunner::executeQuery(self::$baseSql);
        $userArray = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        $users = array();
        foreach($userArray as $user) {
            $users[$user["id"]] = new User($user);
        }
        return $users;
    }

    public function findById($id) {
        $sql = self::$baseSql . " where id = " . $id;
        $statement = DBQueryRunner::executeQuery($sql);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function findByEmail($email) {
        $sql = self::$baseSql . " where email = '" . $email . "'";
        $statement = DBQueryRunner::executeQuery($sql);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

}

?>