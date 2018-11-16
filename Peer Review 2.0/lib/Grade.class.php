<?php

class Grade extends DomainObject
{
    static function getFieldNames()
    {
        return array("GradeID", "Participation", "Contribution", "Attendance", 
                     "Supportiveness", "Communication", "StudentID", "GraderID", 
                     "EvaluationID");
    }

    public function __construct(array $data, $generateException)
    {
        parent::__construct($data, $generateException);
    }
}

?>