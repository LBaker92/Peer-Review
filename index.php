<?php
session_start();

// If the user is already logged in
if (isset($_SESSION["logged_in"])) {
    // If they are an admin, send them to the admin page.
    if ($_SESSION["permissions"] == "admin") {
        header("Location: admin/index.php");
    } 
    // If they are a student, send to student page.
    else if ($_SESSION["permissions"] == "student") {
        header("Location: student/index.php");
    }
    // If they are logged in, but they are not a student or admin
    else {
        header("Location: error.php");
    }
}
// If they are not logged in, take them to login page.
else {
    header("Location: login.php");
}

?>