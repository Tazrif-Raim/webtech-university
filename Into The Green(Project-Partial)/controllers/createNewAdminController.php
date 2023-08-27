<?php
require '../models/model.php';
function register($data){
    if(!preg_match("/^[a-zA-Z ]*$/",test_input($data['firstName']))){
        return "Only letters and white space allowed in First Name";
    }
    else if(!preg_match("/^[a-zA-Z ]*$/",test_input($data['lastName']))){
        return "Only letters and white space allowed in Last Name";
    }
    else if(!preg_match("/^[a-zA-Z0-9._-]*$/",test_input($data['username']))){
        return "Only alphanumeric characters, period, dash or underscore allowed in Username";
    }
    else if(strlen(test_input($data['password']))<8){
        return "Password must be atleast 8 characters";
    }
    else if(!preg_match("/[@,#,$,%]/",test_input($data['password']))){
        return "Password must contain at least one of the special characters (@, #, $,%)";
    }
    else if($data['password'] != $data['confirmPassword']){
        return "Password and Confirm Password must match";
    }
    else if(!filter_var(test_input($data['email']), FILTER_VALIDATE_EMAIL)){
        return "Email must be a valid email address";
    }
    $row = doesUsernameExist($data['username']);
    if($row!=null){
        return "Username already exists";
    }
    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
    if($data['type']=='Admin'){
        insertUser($data);
    }
    header('Location: ../views/adminDashboard.php');
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>