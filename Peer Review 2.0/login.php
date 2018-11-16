<?php
session_start();

// If the user already has a session
if (!empty($_SESSION['user'])) {
    if ($_SESSION['user']['admin']) {
        header('Location: admin.php');
    }
    else {
        header('Location: student.php');
    }
}
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
        <div class="login-box">
            <div class="col-md-12 pb-3"><h3 class="text-center">Peer Review Login</h3></div>
            <form class="needs-validation" action="lib/loginValidator.php" method="post" novalidate>
                <div class="form-group">
                    <label for="email-field"><strong>Email</strong></label>
                    <?php if (!empty($_SESSION['errors']['email'])) { ?>
                    <input type="text" class="form-control is-invalid" name="email" id="email-field" placeholder="Enter your email." required>
                    <?php } else if (!empty($_SESSION['email'])) { ?>
                    <input type="text" class="form-control" name="email" id="email-field" value="<?= $_SESSION['email']; ?>" required>
                    <?php } else { ?>
                    <input type="text" class="form-control" name="email" id="email-field" placeholder="Enter your email." required>
                    <?php } ?>
                    <?php if (!empty($_SESSION['errors']['email'])) { ?>
                    <div class="invalid-feedback"> * <?= $_SESSION['errors']['email'] ?> </div>
                    <?php } else { ?>
                    <div class="invalid-feedback"> * You must enter an email.</div>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <label for="password-field"><strong>Password</strong></label>
                    <?php if (!empty($_SESSION['errors']['password'])) { ?>
                    <input type="password" class="form-control is-invalid" name="password" id="password-field" placeholder="Enter your password." required>
                    <?php } else if (!empty($_SESSION['password'])) { ?>
                    <input type="password" class="form-control" name="password" id="password-field" value="<?= $_SESSION['password']; ?>" required>
                    <?php } else { ?>
                    <input type="password" class="form-control" name="password" id="password-field" placeholder="Enter your password." required>
                    <?php } ?>
                    <?php if (!empty($_SESSION['errors']['password'])) { ?>
                    <div class="invalid-feedback"> * <?= $_SESSION['errors']['password'] ?> </div>
                    <?php } else { ?>
                    <div class="invalid-feedback"> * You must enter a password.</div>
                    <?php } ?>
                </div>
                <div class="form-group pt-2">
                    <button type="submit" class="btn btn-secondary btn-block">Submit</button>
                </div>
            </form>
        </div>
    <script src="js/validation.js"></script>
    </body>
</html>