<?php

class GradeCriteriaTableGateway extends TableDataGateway
{
    public function __construct($dbAdapter)
    {
        parent::__construct($dbAdapter);
    }

    protected function getTableName()
    {
        return "gradecriteria";
    }

    protected function getDomainObjectClassName()
    {
        return "GradeCriteria";
    }

    protected function getOrderFields()
    {
        return "Title";
    }

    protected function getPrimaryKeyName()
    {
        return "Title";
    }
}

?>