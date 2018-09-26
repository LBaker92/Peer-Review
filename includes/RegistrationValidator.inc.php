<?php

if (isset($_POST["submit"])) {
    $formData = array(
        "email" => $_POST["email"],
        "password" => $_POST["password"],
        "fname" => $_POST["fname"],
        "lname" => $_POST["lname"]
    );

    print_r($formData);

    if (inputMissing($formData)) {
        $url = generateRedirectUrl("register.php", $formData);
        header("Location:" . $url);
    }


}

?>