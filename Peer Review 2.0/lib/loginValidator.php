<?php
include '../includes/config.inc.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //print_r($_POST);
        if (!empty($_POST['email'])) {
            $instructorGate = new InstructorTableGateway($dbAdapter);
            $instructor = $instructorGate->findByEmail($_POST['email']);
            if ($instructor) {
                if ($instructor->Password == $_POST['password']) {
                    $_SESSION['user'] = $instructor;
                    header('Location: ../admin.php');
                }
                else {
                    header('Location: ../login.php?password=INVALID');
                }
            }
            else {
                header('Location: ../login.php?email=DNE');
            }
        }
        else {
            header('Location: ../login.php?email=ERROR');
        }
    }
    else {
        header('Location: ../login.php');
    }

    ?>
</body>
</html>