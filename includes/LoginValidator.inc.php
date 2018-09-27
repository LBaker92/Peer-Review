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
        $user = $gateHandler->getUserGate()->findByEmail($formData["email"]);

        // If we were able to retrieve the user from the database
        if (!empty($user)) {
            // If the passwords match, start the session.
            if ($formData["password"] == $user->getPassword()) {
                session_start();
                $_SESSION["id"] = $user->getId();
                $_SESSION["email"] = $user->getEmail();
                $_SESSION["password"] = $user->getPassword();
                $_SESSION["permissions"] = $user->getRole();
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

?>