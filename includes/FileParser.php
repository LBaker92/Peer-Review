<?php

include_once '../lib/gateways/StudentTableGateway.class.php';

if (isset($_POST["submit"])) {
    /*

    Note: File must be on the server before parsing

    1. Create a directory string
    2. Perform check to make sure file is .csv
    3. Move the file to that directory

    */
    
    $targetDir = "../uploads/rosters/";
    $targetFile = $targetDir . $_FILES["roster"]["name"];

    move_uploaded_file($_FILES["roster"]["tmp_name"], $targetFile);

    ini_set('auto_detect_line_endings',TRUE);

    $studentgate = new StudentTableGateway();

    $file = fopen($targetFile, "r") or die("BAD FILE PATH");
    $headers = fgetcsv($file, ","); // Call fgetcsv to start iterating after the headers
    while (true) {
        $row = fgetcsv($file, ",");
        if (!feof($file)) { // Make sure we aren't at the end of the file after we got the next line.
            $studentInfo = array(
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

            $studentInfo["last_name"] = $row[0];
            $studentInfo["first_name"] = $row[1];
            $studentInfo["username"] = $row[2];
            $studentInfo["email"] = $studentInfo["username"] . "@kent.edu";
            $studentInfo["password"] = $studentInfo["first_name"] . $studentInfo["last_name"] . (string)mt_rand(100, 999);

            $studentgate->insert(new Student($studentInfo));
        }
        else {  // If we are at the end of the file, break the loop.
            break;
        }
    }

}


?>