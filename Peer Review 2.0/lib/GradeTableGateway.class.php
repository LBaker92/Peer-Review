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
        $sql = $this->getSelectStatement() . " WHERE StudentID = ?";
        return $this->convertRecordsToObjects($this->dbAdapter->fetchAsArray($sql, $studentID));
    }

    public function findByGraderID($graderID)
    {
        $sql = $this->getSelectStatement() . " WHERE GraderID = ?";
        return $this->convertRecordsToObjects($this->dbAdapter->fetchAsArray($sql, $graderID));
    }
    public function findByEvaluationID($evalID)
    {
        $sql = $this->getSelectStatement() . " WHERE EvaluationID = ?";
        return $this->convertRecordsToObjects($this->dbAdapter->fetchAsArray($sql, $evalID));
    }

    public function update($grade)
    {
        $fieldsToUpdate = array(
            "Participation" => $grade->Participation,
            "Contribution" => $grade->Contribution,
            "Attendance" => $grade->Attendance,
            "Supportiveness" => $grade->Supportiveness,
            "Communication" => $grade->Communication
        );

        $this->dbAdapter->update($this->getTableName(),
                                 $fieldsToUpdate,
                                 "StudentID = :studentID and GraderID = :graderID",
                                 array(":studentID" => $grade->StudentID,
                                        ":graderID" => $grade->GraderID
                                ));
    }
}

?>