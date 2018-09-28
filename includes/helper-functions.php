<?php

include_once '../lib/gateways/Student.class.php';

function inputMissing($postVariables) {

    foreach ($postVariables as $field) {
        if (empty($field)) {
            return true;
        }
    }
    return false;
}

function generateRedirectUrl($phpfilename, $postVariables) {

    $url = "../" . $phpfilename . "?";
    $queryString = "";
    $arrayKeys = array_keys($postVariables);
    $lastKey = end($arrayKeys);

    foreach ($postVariables as $key => $value) {
        if (empty($value)) {
            $queryString .= $key . "=empty";
        }
        else if ($key == "email") {
            // If the email entered is in proper email formatting
            if (preg_match("/^[a-zA-Z0-9.!#$%&’*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/", $value)) {
                $queryString .= $key . "=" . $value;
            }
        }
        // Make a string as long as it isn't the password
        else if ($key != "password") {
            $queryString .= $key . "=" . $value;
        }
        if ($key != $lastKey) {
            $queryString .= "&";
        }
    }
    return $url . $queryString;
}

// Saves the file to the server and returns the file path on the server
function saveToServer($fileToSave) {

    $targetDir = "../uploads/rosters/";
    $targetFile = $targetDir . $fileToSave["roster"]["name"];

    move_uploaded_file($fileToSave["roster"]["tmp_name"], $targetFile);

    return $targetFile;

}

function parseCsv($filePath) {

    // Look for non windows line endings
    ini_set('auto_detect_line_endings', FALSE);

    $studentArray = array();

    $file = fopen($filePath, "r") or die("BAD FILE PATH");
    $headers = fgetcsv($file, ","); // Call fgetcsv to start iterating after the headers
    while (true) {
        $row = fgetcsv($file, ",");
        if (!feof($file)) { // Make sure we aren't at the end of the file after we got the next line.
            $student = array(
                "last_name" => "",
                "first_name" => "",
                "username" => "",
                "email" => "",
                "password" => 123
            );

                /*

                CSV FILE FORMAT IS:
                row[0] = LastName
                row[1] = FirstName
                row[3] = Username

                */

            $student["last_name"] = $row[0];
            $student["first_name"] = $row[1];
            $student["username"] = $row[2];
            $student["email"] = $student["username"] . "@kent.edu";
            $student["password"] = $student["first_name"] . $student["last_name"] . (string)mt_rand(100, 999);

            array_push($studentArray, new Student($student));
        }
        else {  // If we are at the end of the file, break the loop.
            break;
        }
    }
    ini_set('auto_detect_line_endings', FALSE);

    return $studentArray;
}