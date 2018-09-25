<?php
session_start()
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration Page</title>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
    include_once("includes/header.php");
    ?>

    <script src="js/LoginFormHandler.js"></script>
<main class="container-fluid">
    <div class="row">
        <div class="form-container">
            <form action="php/validate.php" method="post" id="login-form">            
                <div class="form-group">
                    <label for="Email">Email</label>
                    <input type="email" name="Email" class="form-control" id="form-email" placeholder="you@email.com" required>
                </div>
                <div class="form-group">
                    <label for="Password">Password</label>
                    <input type="password" name="Password" class="form-control" id="form-password" required>
                </div>
                <div class="form-group">
                    <label for="FirstName">First Name</label>
                    <input type="text" name="FirstName" class="form-control" id="form-firstname" required>
                </div>
                <div class="form-group">
                    <label for="LastName">Last Name</label>
                    <input type="text" name="LastName" class="form-control" id="form-lastname" required>
                </div>
                <button type="submit" class="btn submit-btn">Register</button>
                <p class="subtext">Already have an account?<a href="login.php" id="create-account"> Sign in.</a></p>
            </form>
        </div>
    </div>
</main>
    
</body>
</html>