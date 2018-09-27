<?php

include_once '../lib/db/DBQueryRunner.class.php';
include_once 'User.class.php';

class UserTableGateway {

    private static $db;

    private static $baseSql = "Select * from users";

    public function __construct($connection) {
        self::$db = $connection;
    }

    public function findAll() {
        $statement = DBQueryRunner::executeQuery(self::$baseSql);
        $userArray = $statement->fetchAll(PDO::FETCH_ASSOC);

        $users = array();
        foreach($userArray as $user) {
            $users[$user["user_id"]] = new User($user);
        }

        return $users;
    }

    public function findById($id) {
        self::$baseSql . " where id = " . $id;
        $statement = DBQueryRunner::executeQuery(self::$baseSql);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }


}

?>