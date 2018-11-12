<?php

class GradeCriteria extends DomainObject 
{
    static function getFieldNames()
    {
        return array("Title", "Description", "Weight");
    }

    public function __construct(array $data, $generateException)
    {
        parent::__construct($data, $generateException);
    }
}


?>