<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
</head>
<link rel="stylesheet" href="css/style.css">
<body>
    <div class="login-box">
        <form action="lib/loginValidator.php" method="post">
            <div class="form-group">
                <label for="email-field">Email</label>
                <input type="text" class="form-control" name="email" id="email-field" placeholder="Enter your email.">
            </div>
            <div class="form-group">
                <label for="password-field">Password</label>
                <input type="text" class="form-control" name="password" id="password-field" placeholder="Enter your password.">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary btn-block" value="Login">
            </div>
        </form>
    </div>
</body>
</html>