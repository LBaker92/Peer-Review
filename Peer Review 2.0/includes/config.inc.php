<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

define('DBCONNECTION', "mysql:host=localhost;dbname=peer_reviews");
define('DBUSER', "admin");
define('DBPASS', "admin123");

// Include all the class files in the lib folder
spl_autoload_register(function ($class) {
    $file = 'lib/' . $class . '.class.php';
    if (file_exists($file)) {
        include $file;
    }
});

$dbAdapter = DatabaseAdapterFactory::create('PDO', array(DBCONNECTION, DBUSER, DBPASS));

?>