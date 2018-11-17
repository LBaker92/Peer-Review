<?php

class EvaluationTableGateway extends TableDataGateway
{
    public function __construct($dbAdapter)
    {
        parent::__construct($dbAdapter);
    }

    protected function getTableName()
    {
        return "Evaluations";
    }

    protected function getDomainObjectClassName()
    {
        return "Evaluation";
    }

    protected function getOrderFields()
    {
        return "Year";
    }

    protected function getPrimaryKeyName()
    {
        return "EvaluationID";
    }

    public function insert($eval)
    {
        $success = $this->dbAdapter->insert($this->getTableName(), $eval->getFieldValues());
        if (!$success) {
            throw new PDOException;
        }
    }
}

?>