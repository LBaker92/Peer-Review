<?php
session_start();
$_SESSION["user"]["graded"] = false; // if the student completed a group evaluation

header("Location: student/evaluation.php");
?>