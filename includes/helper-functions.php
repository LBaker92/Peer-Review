<?php

function inputMissing($postVariables) {

    foreach($postVariables as $field) {
        if (empty($field)) {
            return true;
        }
    }
    return false;
}

function generateRedirectUrl($postVariables) {

    $url = "../login.php?";
    $queryString = "";
    $arrayKeys = array_keys($postVariables);
    $lastKey = end($arrayKeys);

    foreach($postVariables as $key => $value) {
        if (empty($value)) {
            $queryString .= $key . "=empty";
            if ($key != $lastKey) {
                $queryString .= "&";
            }
        }
    }
    return $url . $queryString;
}

?>