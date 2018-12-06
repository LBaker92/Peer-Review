<?php
include 'includes/helpers.inc.php';
session_start();

// If the user already has a session
if (!empty($_SESSION['user'])) {
    if ($_SESSION['user']['admin']) {
        header('Location: admin/index.php');
        exit();
    }
    else {
        header('Location: student/index.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Login Page</title>
        <?php insertLinks(); ?>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div class="login-box">
            <div class="col-md-12 pb-3"><h3 class="text-center">Peer Review Login</h3></div>
            <form class="needs-validation" action="lib/LoginValidator.php" method="post" novalidate>
                <div class="form-group">
                    <label for="email-field"><strong>Email</strong></label>
                    <?php if (!empty($_SESSION['errors']['email'])) { ?>
                    <input type="email" class="form-control is-invalid" name="email" id="email-field" placeholder="Enter your email." required>
                    <?php } else if (!empty($_SESSION['email'])) { ?>
                    <input type="email" class="form-control" name="email" id="email-field" value="<?= $_SESSION['email']; ?>" required>
                    <?php } else { ?>
                    <input type="email" class="form-inline form-control" name="email" id="email-field" placeholder="Enter your email." required>
                    <?php } ?>
                    <?php if (!empty($_SESSION['errors']['email'])) { ?>
                    <div class="d-inline invalid-feedback"><?= $_SESSION['errors']['email'] ?> </div>
                    <?php } else { ?>
                    <div class="invalid-feedback">You must enter a valid email address.</div>
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
                    <div class="invalid-feedback"> <?= $_SESSION['errors']['password'] ?> </div>
                    <?php } else { ?>
                    <div class="invalid-feedback"> You must enter a password.</div>
                    <?php } ?>
                </div>
                <div class="form-group pt-2 text-center">
                    <button type="submit" class="btn btn-dark">Submit</button>
                </div>
            </form>
        </div>
    <script src="js/validation.js"></script>
    </body>
</html>