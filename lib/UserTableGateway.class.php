<?php

include_once('DBConnection.class.php');
include_once('DBQuery.class.php');

class UserTableGateway {

    private static $db;

    public __construct($connection) {
        self::$db = $connection;
    }





}



?>