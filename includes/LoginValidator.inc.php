<?php
include_once "../lib/DBConnector.class.php";
include_once "helper-functions.php";

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
        $pdo = DBConnector::createInstance();
        $conn = $pdo->getConnection();

        $sql = "SELECT * FROM `users` WHERE email = \"" . $formData["email"] . "\"";
        $statement = $conn->prepare($sql);
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);

        // If we were able to retrieve a user in the database with that email
        if (!empty($user)) {
            // Compare passwords
            if ($formData["password"] == $user["password"]) {
                session_start();
                $_SESSION["email"] = $user["email"];
                $_SESSION["password"] = $user["password"];
                $_SESSION["permissions"] = $user["role"];
                $_SESSION["logged_in"] = true;
                header("Location: ../index.php");
            } 
            else {
                header("Location: ../login.php?password=invalid");
            }
        } 
        else {
            header("Location: ../register.php?error=email+not+found&email=" . $formData["email"]);
            print("WRONG EMAIL");
        }
    }
} 
else {
    header("Location: ../login.php");
}
