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
include_once "includes/header.php";
?>

    <script src="js/FormHandler.js"></script>
    <main class="container-fluid">

    <?php
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "email not found") {
            echo
            "
            <div class='row'>
                <div class='col-md-4'></div>
                <div class='col-md-4 pt-3'>
                    <div class='alert alert-danger text-center mb-0' role='alert'>
                        <strong>Uh-oh!</strong> The email address you entered does not exist.<br>Now's your chance to grab it!</div>
                </div>
                <div class='col-md-4'></div>
            </div>
            ";
        }
    }
    ?>
    <div class="row">
        <div class="form-container">
            <form action="includes/RegistrationValidator.inc.php" method="post" id="register-form" novalidate>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" 
                    <?php
                    if (isset($_GET["error"])) {
                        if ($_GET["error"] == "email not found") { 
                            echo "value='" . $_GET["email"] . "'";
                        }
                    }
                    ?>
                    class="form-control" id="form-email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="form-password" required>
                </div>
                <div class="form-group">
                    <label for="fname">First Name</label>
                    <input type="text" name="fname" class="form-control" id="form-firstname" required>
                </div>
                <div class="form-group">
                    <label for="lname">Last Name</label>
                    <input type="text" name="lname" class="form-control" id="form-lastname" required>
                </div>
                <button type="submit" class="btn submit-btn">Register</button>
                <p class="subtext">Already have an account?<a href="login.php" id="create-account"> Sign in.</a></p>
            </form>
        </div>
    </div>
</main>

</body>
</html>