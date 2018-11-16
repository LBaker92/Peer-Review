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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
</head>
    <body>
    <?php
    if (!empty($_GET['error'])) {
        if ($_GET['error'] == 'email') {
    ?>
        <div class="login-box">
            <form class="needs-validation" action="lib/loginValidator.php" method="post" novalidate>
                <div class="form-group">
                    <label for="email-field">Email</label>
                    <input type="text" class="form-control is-invalid" name="email" id="email-field" placeholder="Enter your email." required>
                    <div class="invalid-feedback">* There was a problem with this email.</div>
                </div>
                <div class="form-group">
                    <label for="password-field">Password</label>
                    <input type="text" class="form-control" name="password" id="password-field" placeholder="Enter your password." required>
                    <div class="invalid-feedback">* A password is required.</div>
                </div>
                <button type="submit" class="btn btn-secondary btn-block">Submit</button>
            </form>
        </div>

    <?php
        }
    ?>


    <?php
    }
    else {
    ?>
        <div class="login-box">
            <form class="needs-validation" action="lib/loginValidator.php" method="post" novalidate>
                <div class="form-group">
                    <label for="email-field">Email</label>
                    <input type="text" class="form-control" name="email" id="email-field" placeholder="Enter your email." required>
                    <div class="invalid-feedback">* An Email address is required.</div>
                </div>
                <div class="form-group">
                    <label for="password-field">Password</label>
                    <input type="text" class="form-control" name="password" id="password-field" placeholder="Enter your password." required>
                    <div class="invalid-feedback">* A password is required.</div>
                </div>
                <button type="submit" class="btn btn-secondary btn-block">Submit</button>
            </form>
        </div>
    <?php
    }
    ?>
    <!-- <script src="js/validation.js"></script> -->
    </body>
</html>