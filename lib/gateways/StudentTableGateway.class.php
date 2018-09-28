<?php

include_once '../lib/db/DBQueryRunner.class.php';
include_once 'Student.class.php';

class StudentTableGateway {

    private static $baseSql = "Select * from Students";

    public function __construct() { }

    public function findAll() {
        $statement = DBQueryRunner::executeQuery(self::$baseSql);
        $StudentArray = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        $Students = array();
        foreach($StudentArray as $Student) {
            $Students[$Student["id"]] = new Student($Student);
        }
        return $Students;
    }

    public function findById($id) {
        $sql = self::$baseSql . " where id = " . $id;
        $statement = DBQueryRunner::executeQuery($sql);
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return new Student($result);
    }

    public function findByEmail($email) {
        $sql = self::$baseSql . " where email = '" . $email . "'";
        $statement = DBQueryRunner::executeQuery($sql);
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return new Student($result);
    }

    // Clean up SQL later
    public function insert($student) {
        $sql = "INSERT INTO student (first_name, last_name, username, email, password)
        VALUES(\"" . $student->getFirstName() . "\", \"" . $student->getLastName() . "\", \""
                   . $student->getUsername() . "\", \"" . $student->getEmail() . "\", \"" . $student->getPassword() . "\")";
        $statement = DBQueryRunner::executeQuery($sql);
    }
}

?>