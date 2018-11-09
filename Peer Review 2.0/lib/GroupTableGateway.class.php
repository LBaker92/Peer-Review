<?php

class GroupTableGateway extends TableDataGateway
{
    public function __construct($dbAdapter)
    {
        parent::__construct($dbAdapter);
    }

    protected function getTableName()
    {
        return "Groups";
    }

    protected function getDomainObjectClassName()
    {
        return "Group";
    }

    protected function getOrderFields()
    {
        return "ProjectName";
    }

    protected function getPrimaryKeyName()
    {
        return "GroupID";
    }

    // Additional database querying functionality here
}

?>