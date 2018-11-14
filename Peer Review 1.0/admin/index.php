<?php
session_start();

if (!isset($_SESSION["logged_in"])) {
    header("Location: ../login.php");
}

include_once '../lib/gateways/GatewayHandler.class.php';

$gateHandler = new GatewayHandler();

$adminSettings = $gateHandler->getAdminSettingsGate()->getAllSettings();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ADMIN</title>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <?php
     include_once '../includes/header.php'; 
     ?>

    <div class="container pt-5">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <form class="database-filler" action="../includes/FileParser.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="file"><h4><b>CLASS ROSTER</b></h4></label>
                        <input type="file" name="roster" class="form-control-file" id="roster">
                        <p class="error-text pt-1">* File should be in .csv format.</p>
                    </div>
                    <div class="text-center">
                        <button type="submit" name="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</body>
</html>