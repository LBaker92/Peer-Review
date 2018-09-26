<?php
include_once("./DBConnection.class.php");
include_once("./helper-functions.php");

if (isset($_POST["submit"])) {

    $formData = array(
        "email" => $_POST["email"],
        "password" => $_POST["password"]
    );

    if (inputMissing($formData)) {
        $url = generateRedirectUrl($formData);
        header("Location:" . $url);
    }

    $pdo = DBConnection::createInstance();
    $conn = $pdo->getConnection();

    $sql = "SELECT * FROM `users` WHERE user_email = \"" . $formData["email"] . "\"";
    $statement = $conn->prepare($sql);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    // If we were able to retrieve a user in the database with that email
    if (!empty($user)) {
        // Compare passwords
        if ($formData["password"] == $user["user_password"]) {
            session_start();
            $_SESSION["email"] = $user["user_email"];
            $_SESSION["password"] = $user["user_password"];
            $_SESSION["permissions"] = $user["user_role"];
            $_SESSION["logged_in"] = true;
            header("Location: ../index.php");
        }
        else {
            print("INVALID PASSWORD");
        }
    }
    else {
        print("WRONG EMAIL");
    }
}
else {
    header("Location: ../login.php");
}

?>