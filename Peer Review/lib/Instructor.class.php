<?php

/*

Represents a single row of the Instructor table.
This is a concrete implementation of the Domain Model pattern.

*/

class Instructor extends DomainObject
{
    static function getFieldNames() {
        return array('InstructorID', 'FirstName', 'LastName', 'Email', 'Password');
    }

    public function __construct(array $data, $generateExec)
    {
        parent::__construct($data, $generateExec);
    }

    public function getFullName($isCommaDelimited=false)
    {
        if ($isCommaDelimited) {
            return $this->LastName . ', ' . $this->FirstName;
        } 
        else {
            return $this->LastName . ' ' . $this->FirstName;
        }
    }
}

?>