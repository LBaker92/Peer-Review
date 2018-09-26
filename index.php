<?php
session_start();

if (isset($_SESSION["logged_in"])) {
    if ($_SESSION["permissions"] == "admin") {
         header("Location: admin/index.php");
    }
    else if ($_SESSION["permission"] == "student") {
    ?>
    
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Student View</title>
    </head>
    <body>
        <h1>STUDENT PAGE</h1>
        <button><a href="logout.php">LOGOUT</a></button>
    </body>
    </html>

    <?php
    }
    else {
        header("Location: error.php");
    }
}
else {
    header("Location: login.php");
}
?>