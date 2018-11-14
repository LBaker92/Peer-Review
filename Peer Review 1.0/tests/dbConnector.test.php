<?php

include_once '../lib/DBConnector.class.php';

$db = DBConnector::createInstance()->getConnection();

print_r($db);


?>