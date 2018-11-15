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
        $gradeArray = $this->findBy("StudentID = ?", $studentID);
        if (count($gradeArray) > 0) {
            // findBy returns an array, so we return the first index
            return $gradeArray[0];
        }
        else {
            return NULL;
        }
    }

    public function findByGraderID($graderID)
    {
        $gradeArray = $this->findBy("GraderID = ?", $graderID);
        if (count($gradeArray) > 0) {
            // findBy returns an array, so we return the first index
            return $gradeArray[0];
        }
        else {
            return NULL;
        }
    }

    public function findByEvaluationID($evalID)
    {
        $gradeArray = $this->findBy("EvaluationID = ?", $evalID);
        if (count($gradeArray) > 0) {
            // findBy returns an array, so we return the first index
            return $gradeArray[0];
        }
        else {
            return NULL;
        }
    }
}

?>