<?php
require '../models/registrationModel.php';
function validateUser($username, $password, $confirmPassword, $email, $type){
    if(doesUsernameExist($username)){
        return "Username already exists";
    }
    if($password!=$confirmPassword){
        return "Passwords do not match";
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        return "Invalid email";
    }
    if(!preg_match("/^[a-zA-Z0-9._-]*$/",$username)){
        return "Only letters, numbers, period, underscore and dash allowed in Username";
    }
    if(strlen($password)<8){
        return "Password must be atleast 8 characters";
    }
    if(!preg_match("/[@,#,$,%]/",$password)){
        return "Password must contain at least one of the special characters (@, #, $,%)";
    }
    addUser($username, $password, $email, $type);
    return "Sign Up Successful";
}

?>