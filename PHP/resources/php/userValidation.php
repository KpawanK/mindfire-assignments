<?php 
function test_input( $data ) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function validate_name($name){
    $temp = test_input($name);
    if(preg_match("/^[a-zA-Z ]*$/",$temp))
        return true;
    return false;
}

function validate_password($password){
    if(strlen($password)>=7)
        return true;
    return false;
}


function validate_email($email){
    $temp = test_input($email);
    if(filter_var($temp, FILTER_VALIDATE_EMAIL))
        return true;
    return false;
}

function validate_number($number){
    $temp = test_input($number);
    test_input($_POST["number"]);
    if(preg_match('/^[0-9]{3}[0-9]{3}[0-9]{4}$/',$number))
        return true;
    return false;
}

function validate_age($age){
    $temp=$age;
    if($temp>=20 && $temp<=30)
        return true;
    return false;
}

