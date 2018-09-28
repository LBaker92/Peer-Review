<?php

include 'DBConnector.class.php';

class DBQueryRunner {

    private static $pdo = null;

    function __construct() { }

    public function setConnection() {
        self::$pdo = DBConnector::createInstance()->getConnection();
    }

    public function executeQuery($sql) {
        self::$pdo ?: self::setConnection();
        $statement = self::$pdo->prepare($sql);
        $successful = $statement->execute();

        if (!$successful) {
            throw new PDOException;
        }
        return $statement;
    }
}


?>