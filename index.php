<?php
session_start();

// if (!isset($_SESSION['client'])) {
//     header("Location: register.php"); 
// }
// else {
//     header("Location: login.php");
// }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Landing Page</title>
</head>
<body>
    <button><a href="logout.php">LOGOUT</a></button>
</body>
</html>