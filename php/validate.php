<?php
session_start();

include ("../includes/DBConnection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["Firstname"])) {
        $fName = $_POST["Firstname"];
    }
    $lName = $_POST["Lastname"];
    $email = $_POST["Email"];
    $pass = $_POST["Password"];
    $remember = $_POST["Remember"];
    print($remember);
}

$error = "";

try {
    $dbConnection = new PDO(DBCONNECTION, DBUSER, DBPASS);
    $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$sql = "SELECT Email, Password FROM users WHERE Email = " . "\"" . $email . "\"";

$query = $dbConnection->prepare($sql);
try {
    $query->execute();
} catch(PDOException $e) {
    echo "ERROR: " . $e->getMessage();
}

$user = $query->fetch(PDO::FETCH_ASSOC);

if ($user != null) {
    if ($pass == $user["Password"]) {
        if ($remember != null) {
            $_SESSION["Email"] = $email;
        }
    }
    else {
        $_SESSION["FirstName"] = $fName;
        $_SESSION["LastName"] = $lName;
        $_SESSION["Email"] = $email;
        $_SESSION["PasswordError"] = "* Invalid Password";
        // header("Location: ../index.php");
    }
}
// CHECK IF USERNAME EXISTS IN DATABASE
    // EXISTS: CHECK PASSWORD MATCH
        // BAD:     ERROR MESSAGE
    // ELSE:   VERIFY USER/PW IS GOOD
        // GOOD:    ADD TO DB
        // BAD:     ERROR MESSAGE

// 
?>