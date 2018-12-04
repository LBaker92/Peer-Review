<?php

class FinalGrade extends DomainObject
{
    static function getFieldNames()
    {
        return array("StudentID", "EvaluationID", "FirstName", "LastName", "Username", "FinalGrade");
    }

    public function __construct(array $data, $generateException)
    {
        parent::__construct($data, $generateException);
    }
}

?>