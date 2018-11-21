<?php
include '../includes/config.inc.php';
include '../includes/helpers.inc.php';
session_start();

if (!empty($_SESSION['user'])) {
    // Redirect a student back to the student page
    if (!$_SESSION['user']['admin']) {
        header('Location: ../student.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Page</title>
    <?php insertLinks(); ?>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php insertNavbar(); ?>
    <pre>
    <?php // print_r($_SESSION["user"]); ?>
    </pre>
    <div class="container">
        <div class="row py-5"></div>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <p>test</p>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
    <script src="js/validation.js"></script>
</body>
</html>