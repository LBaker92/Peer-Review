<?php
include_once '../lib/gateways/UserTableGateway.class.php';
include_once '../lib/db/DBConnector.class.php';

echo "<h1>USER TABLE GATEWAY TESTS</h1>";

$usergate = new UserTableGateway(DBConnector::createInstance()->getConnection());

echo "<h3>findById()</h3>";
echo "<p><strong>ID = 1</strong></p></h3>";
$user = $usergate->findById(1);
print_r($user);
echo "<br>";

echo "<p><strong>ID = 2</strong></p></h3>";
$user = $usergate->findById(2);
print_r($user);
echo "<br>";

echo "<h3>findAll()</h3>";
$users = $usergate->findAll();
foreach($users as $user) {
    print_r($user);
    echo "<br>";
}


?>