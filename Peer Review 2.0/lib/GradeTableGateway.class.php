<?php

class GradeTableGateway extends TableDataGateway
{
    public function __construct($dbAdapter)
    {
        parent::__construct($dbAdapter);
    }

    protected function getTableName()
    {
        return "Grades";
    }

    protected function getDomainObjectClassName()
    {
        return "Grade";
    }

    protected function getOrderFields()
    {
        return "EvaluationID";
    }

    protected function getPrimaryKeyName()
    {
        return "GradeID";
    }

    public function findByStudentID($studentID)
    {
        return $this->findBy("StudentID = ?", $studentID);
    }

    public function findByGraderID($graderID)
    {
        return $this->findBy("GraderID = ?", $graderID);
    }

    public function findByEvaluationID($evalID)
    {
        return $this->findBy("EvaluationID = ?", $evalID);
    }
}

?>