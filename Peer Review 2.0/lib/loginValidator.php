<?php

include "../includes/config.inc.php";
session_start();

unset($_SESSION["errors"]);
unset($_SESSION["email"]);
unset($_SESSION["password"]);

// If the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check for any empty inputs
    if (empty($_POST["email"]) && empty($_POST["password"])) {
        $_SESSION["errors"]["email"] = "An email address is required.";
        $_SESSION["errors"]["password"] = "A password is required.";
        header("Location: ../login.php");
    }
    else if (empty($_POST["email"]) && !empty($_POST["password"])) {
        $_SESSION["errors"]["email"] = "An email address is required.";
        header("Location: ../login.php");
    }
    else if (!empty($_POST["email"]) && empty($_POST["password"])) {
        $_SESSION["email"] = $_POST["email"];
        $_SESSION["errors"]["password"] = "A password is required.";
        header("Location: ../login.php");
    }

    // Check if the email address is an instructor or student
    $instructorGate = new InstructorTableGateway($dbAdapter);
    $instructor = $instructorGate->findByEmail($_POST["email"]);
    if (!$instructor) {
        $studentGate = new StudentTableGateway($dbAdapter);
        $student = $studentGate->findByEmail($_POST["email"]);
        if (!$student) {
            $_SESSION["password"] = $_POST["password"];
            $_SESSION["errors"]["email"] = "No account with that email exists.";
            header("Location: ../login.php");
        }
        // If a student was found with that email
        else {
            if ($student->Password == $_POST["password"]) {
                $_SESSION["user"] = $student->getFieldValues();
                $_SESSION["user"]["admin"] = false;
                header("Location: ../student.php");
            }
            else {
                $_SESSION["email"] = $_POST["email"];
                $_SESSION["errors"]["password"] = "Invalid password was entered.";
                header("Location: ../login.php");
            }
        }
    }
    // If an instructor was found with that email
    else {
        // Check the password
        if ($instructor->Password == $_POST["password"]) {
            $_SESSION["user"] = $instructor->getFieldValues();
            $_SESSION["user"]["admin"] = true;
            header("Location: ../admin.php");
        }
        else {
            $_SESSION["email"] = $_POST["email"];
            $_SESSION["errors"]["password"] = "Invalid password was entered.";
            header("Location: ../login.php");
        }
    }
}

?>