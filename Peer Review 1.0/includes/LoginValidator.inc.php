<?php

include_once '../lib/gateways/GatewayHandler.class.php';
include_once "helper-functions.php";

// If the user submitted a form.
if (isset($_POST["submit"])) {

    $formData = array(
        "email" => $_POST["email"],
        "password" => $_POST["password"],
    );

    if (inputMissing($formData)) {
        $url = generateRedirectUrl("login.php", $formData);
        header("Location: " . $url);
    }
    else {

        $gateHandler = new GatewayHandler();

        /*

            LOGIC NEEDED:
            Compare the entered email address with the instructor emails.
                If it is found, compare the entered password with that instructor's password.
                    If it matches, redirect to the admin page.
                    Else go back to login page with password error.

                Else compare the entered email address with the student emails.
                    If it is found, compare the entered password with that instructor's password.
                        If it matches, redirect to the admin page.
                        Else go back to login page with password error.

                Else redirect to the registration page because they are not in the database.

        */

        $instructor = $gateHandler->getInstructorGate()->findByEmail($formData["email"]);

        if (!empty($instructor)) {
            if ($formData["password"] == $instructor->getPassword()) {
                session_start();
                $_SESSION["id"] = $instructor->getId();
                $_SESSION["first_name"] = $instructor->getFirstName();
                $_SESSION["last_name"] = $instructor->getLastName();
                $_SESSION["username"] = $instructor->getUsername();
                $_SESSION["email"] = $instructor->getEmail();
                $_SESSION["password"] = $instructor->getPassword();
                $_SESSION["permissions"] = "admin";
                $_SESSION["logged_in"] = true;
                header("Location: ../admin/index.php");
            }
            // If the password didn't match, send them back to the login page with an error message.
            else {
                header("Location: ../login.php?email=" . $formData["email"] . "&password=invalid");
            }
            // Stop the rest of the validator php from running
        }
        else {
            $student = $gateHandler->getStudentGate()->findByEmail($formData["email"]);

            // If we were able to retrieve the student from the database
            if (!empty($student)) {
                // If the passwords match, start the session.
                if ($formData["password"] == $student->getPassword()) {
                    session_start();
                    $_SESSION["id"] = $student->getId();
                    $_SESSION["email"] = $student->getEmail();
                    $_SESSION["password"] = $student->getPassword();
                    $_SESSION["permissions"] = "student";
                    $_SESSION["logged_in"] = true;
                    header("Location: ../index.php");
                } 
                // If the password didn't match, send them back to the login page with an error message.
                else {
                    header("Location: ../login.php?email=" . $formData["email"] . "&password=invalid");
                }
            }
            // If the email account didn't exist, send them to register.
            else {
                header("Location: ../register.php?error=email+not+found&email=" . $formData["email"]);
                print("WRONG EMAIL");
            }
        }
    }
}

?>