<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>


<body>

<?php 
include 'includes/header.php';
?>

<script src="js/FormHandler.js"></script>
<main class="container-fluid">
    <div class="row">
        <div class="form-container">
            <form action="includes/LoginValidator.inc.php" method="post" id="login-form">
            <?php
            if(isset($_SESSION["logged_in"])) {
                header("Location: ./index.php");
            }

            if(isset($_GET["email"])) {
                if ($_GET["email"] == "empty") {
            ?>
                    <div class='form-group'>
                       <label for='email'>Email</label>
                       <input type='email' name='email' class='form-control form-error' id='form-email' required>
                       <p class='error-text'>* This field is required.</p>
                    </div>
            <?php
                } 
                else {
            ?>
                    <div class='form-group'>
                        <label for='email'>Email</label>
                        <input type='email' name='email' value=" <?= $_GET["email"] ?> " class='form-control' placeholder='username@kent.edu' id='form-email' required>
                    </div>
            <?php
                }
            }
            else {
            ?>
                <div class='form-group'>
                    <label for='email'>Email</label>
                    <input type='email' name='email' class='form-control' placeholder='username@kent.edu' id='form-email' required>
                </div>
            <?php
            }

            if (isset($_GET["password"])) {
                if ($_GET["password"] == "empty") {
            ?>
                    <div class='form-group'>
                        <label for='password'>Password</label>
                        <input type='password' name='password' class='form-control form-error' id='form-password' required>
                        <p class='error-text'>* This field is required.</p>
                    </div>
            <?php
                }
                else if ($_GET["password"] == "invalid") {
            ?>
                    <div class='form-group'>
                        <label for='password'>Password</label>
                        <input type='password' name='password' class='form-control form-error' id='form-password' required>
                        <p class='error-text'>* Invalid password.</p>
                    </div>
            <?php
                }
            } 
            else {
            ?>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="form-password" required>
                </div>
            <?php
            }
            ?>
                <button type="submit" name="submit" class="btn submit-btn">LOGIN</button>
                <p class="subtext text-center">Not registered? <a href="register.php" id="create-account">Create an account.</a></p>
            </form>
        </div>
    </div>
</main>

</body>

</html>