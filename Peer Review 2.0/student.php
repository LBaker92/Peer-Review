<?php
include 'includes/config.inc.php';
include 'includes/helpers.inc.php';
session_start();

if (!empty($_SESSION['user'])) {
    if ($_SESSION['user']['admin']) {
        // Redirect an admin back to the admin page
        header('Location: admin.php');
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
</head>
<body>
    <?php insertNavbar(); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12 py-5 text-center">
                <a href="logout.php">Logout</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <h3>Welcome, <?= $_SESSION['user']['first_name'] ?></h3>
            </div>
        </div>
    </div>
</body>
</html>