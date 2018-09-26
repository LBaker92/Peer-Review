<?php

include_once '../includes/helper-functions.php';

$data = array(
    "email" => null,
    "password" => null
);
$bool = inputMissing($data);

print_r($bool);

echo "<br>";

$url = generateRedirectUrl("login.php", $data);

print($url);