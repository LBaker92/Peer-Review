<?php

class StudentGroup extends DomainObject
{
    private static function getFieldNames()
    {
        return array("GroupID", "ProjectName", "ProjectDescription", "LeaderEmail");
    }

    public function __construct(array $data, $generateExec)
    {
        parent::__construct($data, $generateExec);
    }
}

?>