<?php

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
