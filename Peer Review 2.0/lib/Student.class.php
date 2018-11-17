<?php

/*

Represents a single row of the Student table.
This is a concrete implementation of the Domain Model pattern.

*/

class Student extends DomainObject
{
    static function getFieldNames() {
        return array("StudentID", "FirstName", "LastName", "Email", "Password", "GroupID");
    }

    public function __construct(array $data, $generateExec)
    {
        parent::__construct($data, $generateExec);
    }

    public function getFullName($isCommaDelimited=false)
    {
        if ($isCommaDelimited) {
            return $this->LastName . ", " . $this->FirstName;
        } 
        else {
            return $this->LastName . " " . $this->FirstName;
        }
    }
}

?>