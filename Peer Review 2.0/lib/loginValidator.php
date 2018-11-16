<?php
include '../includes/config.inc.php';
session_start();
?>

<!-- Does this really need HTML??? -->

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
        if (!empty($_POST['email']) && !empty($_POST['password'])) {
            $instructorGate = new InstructorTableGateway($dbAdapter);
            $instructor = $instructorGate->findByEmail($_POST['email']);
            var_dump($instructor);
            if ($instructor) {
                if ($instructor->Password == $_POST['password']) {
                    $_SESSION['user'] = $instructor;
                    header('Location: ../admin.php');
                    exit();
                }
                else {
                    header('Location: ../login.php?password=invalid');
                    exit();
                }
            }
            else {
                $studentGate = new StudentTableGateway($dbAdapter);
                $student = $studentGate->findByEmail($_POST['email']);
                if ($student) {
                    if ($student->Password == $_POST['password']) {
                        $_SESSION['user'] = $student;
                        header('Location: ../student.php');
                        exit();
                    }
                    else {
                        header('Location: ../login.php?password=invalid');
                        exit();
                    }
                }
            }
        }
        else if (!empty($_POST['email']) && empty($_POST['password'])) {
            header('Location: ../login.php?email=' . $_POST['email'] . '&password=missing');
        }
        else if (empty($_POST['email']) && !empty($_POST['password'])) {
            header('Location: ../login.php?email=missing');
        }
    }
    else {
        header('Location: ../login.php');
    }

    ?>
</body>
</html>