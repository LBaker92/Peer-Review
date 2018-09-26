<?php
session_start();

if (isset($_SESSION["logged_in"])) {
    if ($_SESSION["permissions"] == "admin") {
        header("Location: admin/index.php");
    }
    else if ($_SESSION["permissions"] == "student") {
        header("Location: student/index.php");
    }
    else {
        header("Location: error.php");
    }
}
else {
    header("Location: login.php");
}
?>