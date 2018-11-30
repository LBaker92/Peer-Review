<?php

class Evaluation extends DomainObject
{
    static function getFieldNames()
    {
        return array("EvaluationID", "CourseID", "CourseTitle", "Section", "Semester", "Year", "InstructorID");
    }

    public function __construct(array $data, $generateException)
    {
        parent::__construct($data, $generateException);
    }
}

?>