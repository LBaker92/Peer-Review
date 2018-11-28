<?php
session_start();

// This also destroys whether or not the person has already graded
session_destroy();
header('Location: login.php');
?>