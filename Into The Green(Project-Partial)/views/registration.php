<?php
require '../controllers/registrationController.php';
$msg = '';
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if($_POST['submit'] == 'Register'){
        $data['firstName'] = $_POST['firstName'];
        $data['lastName'] = $_POST['lastName'];
        $data['username'] = $_POST['username'];
        $data['password'] = $_POST['password'];
        $data['confirmPassword'] = $_POST['confirmPassword'];
        $data['email'] = $_POST['email'];
        $data['type'] = $_POST['type'];
        if(empty($data['firstName']) || empty($data['lastName']) || empty($data['username']) || empty($data['password']) || empty($data['confirmPassword']) || empty($data['email']) || empty($data['type'])){
            $msg = "Please fill up all the fields";
        }
        else {
            $msg = register($data);
        }
        
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <script>
        function validateForm(){
            if(document.getElementById("firstName").value=="" || document.getElementById("lastName").value=="" || document.getElementById("username").value=="" || document.getElementById("password").value=="" || document.getElementById("confirmPassword").value=="" || document.getElementById("email").value==""){
                document.getElementById("submit").disabled = true;
                return;
            } else {
                document.getElementById("submit").disabled = false;
            }
            if(checkFirstName() && checkLastName() && checkPassword() && checkConfirmPassword() && checkEmail() && checkUsername()){
                document.getElementById("submit").disabled = false;
                return true;
            } else {
                document.getElementById("submit").disabled = true;
                return false;
            }
        }

        function checkFirstName(){
            let firstName = document.getElementById("firstName");
            if(firstName.value == ""){
                document.getElementById("firstNameError").innerHTML = "First Name cannot be empty";
                firstName.style.border = "2px solid red";return false;
            } 
            else {
                const regex = /^[a-zA-Z\s]*$/;
                if(regex.test(firstName.value) == false){
                    document.getElementById("firstNameError").innerHTML = "First Name can only contain letters and white spaces";
                    firstName.style.border = "2px solid red";return false;
                } else {
                    document.getElementById("firstNameError").innerHTML = "";
                    firstName.style.border = "2px solid green";return true;
                }
            }
        }

        function checkLastName(){
            let lastName = document.getElementById("lastName");
            if(lastName.value == ""){
                document.getElementById("lastNameError").innerHTML = "Last Name cannot be empty";
                lastName.style.border = "2px solid red";return false;
            } else {
                const regex = /^[a-zA-Z\s]*$/;
                if(regex.test(lastName.value) == false){
                    document.getElementById("lastNameError").innerHTML = "Last Name can only contain letters and white spaces";
                    lastName.style.border = "2px solid red";return false;
                } else {
                    document.getElementById("lastNameError").innerHTML = "";
                    lastName.style.border = "2px solid green";return true;
                }
            }
        }

        function checkPassword(){
            let password = document.getElementById("password");
            if(password.value == ""){
                document.getElementById("passwordError").innerHTML = "Password cannot be empty";
                password.style.border = "2px solid red";return false;
            } else {
                const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$%@])[a-zA-Z\d#$%@]{8,}$/;
                if(regex.test(password.value) == false){
                    document.getElementById("passwordError").innerHTML = "Password must contain at least 8 characters, 1 uppercase letter, 1 lowercase letter, 1 number and 1 special character(@, #, $, %)";
                    password.style.border = "2px solid red";return false;
                } else {
                    document.getElementById("passwordError").innerHTML = "";
                    password.style.border = "2px solid green";return true;
                }
            }
        }

        function checkConfirmPassword(){
            let confirmPassword = document.getElementById("confirmPassword");
            let password = document.getElementById("password");
            if(confirmPassword.value == ""){
                document.getElementById("confirmPasswordError").innerHTML = "Confirm Password cannot be empty";
                confirmPassword.style.border = "2px solid red";return false;
            } else {
                if(confirmPassword.value !== password.value){
                    document.getElementById("confirmPasswordError").innerHTML = "Confirm Password must match Password";
                    confirmPassword.style.border = "2px solid red";return false;
                } else {
                    document.getElementById("confirmPasswordError").innerHTML = "";
                    confirmPassword.style.border = "2px solid green";return true;
                }
            }
        }

        function checkEmail(){
            let email = document.getElementById("email");
            if(email.value == ""){
                document.getElementById("emailError").innerHTML = "Email cannot be empty";
                email.style.border = "2px solid red";return false;
            } else {
                const regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
                if(regex.test(email.value) == false){
                    document.getElementById("emailError").innerHTML = "Email is not valid";
                    email.style.border = "2px solid red";return false;
                } else {
                    document.getElementById("emailError").innerHTML = "";
                    email.style.border = "2px solid green";return true;
                }
            }
        }

        function checkUsername(){
            let username = document.getElementById("username");
            if(username.value == ""){
                document.getElementById("usernameError").innerHTML = "Username cannot be empty";
                username.style.border = "2px solid red";return false;
            } else {
                const regex = /^[a-zA-Z0-9._-]+$/;
                if(regex.test(username.value) == false){
                    document.getElementById("usernameError").innerHTML = "Username can only contain letters, numbers, period, underscore and dash";
                    username.style.border = "2px solid red";return false;
                } else {
                    document.getElementById("usernameError").innerHTML = "";
                    username.style.border = "2px solid green";return true;
                }
            }
        }

        function showPassword(){
            let password = document.getElementById("password");
            let confirmPassword = document.getElementById("confirmPassword");
            let showPassword = document.getElementById("showPass");
            if(showPassword.checked){
                password.type = "text";
                confirmPassword.type = "text";
            } else {
                password.type = "password";
                confirmPassword.type = "password";
            }
        }
    </script>
</head>
<body>
    <?php require 'nav.php';?>
    <br>
    <h1>Registration</h1>
    <form name="registrationForm" method="post" action="registration.php" onkeyup="validateForm()">
        <label for="firstName">First Name:</label><br>
        <input type="text" name="firstName" id="firstName" onblur="checkFirstName()" onkeyup="checkFirstName()">
        <p id="firstNameError"></p>
        <br>
        <label for="lastName">Last Name:</label><br>
        <input type="text" name="lastName" id="lastName" onblur="checkLastName()" onkeyup="checkLastName()">
        <p id="lastNameError"></p>
        <br>
        <label for="username">Username: </label><br>
        <input type="text" name="username" id="username" onblur="checkUsername()" onkeyup="checkUsername()">
        <p id="usernameError"></p>
        <br>
        <label for="password">Password: </label><br>
        <input type="password" name="password" id="password" onblur="checkPassword()">
        <span>
            <input type="checkbox" name="showPass" id="showPass" onclick="showPassword()">
            <label for="showPass">Show Password</label>
        </span>
        <p id="passwordError"></p>
        <br>
        <label for="confirmPassword">Confirm Password: </label><br>
        <input type="password" name="confirmPassword" id="confirmPassword" onblur="checkConfirmPassword()">
        <p id="confirmPasswordError"></p>
        <br>
        <label for="email">Email: </label><br>
        <input type="email" name="email" id="email" onblur="checkEmail()">
        <p id="emailError"></p>
        <label for="type">Type: </label>
        <?php
            $types = askAllTypes();
            //var_dump($types);
            echo "<select name='type' id='type'>";
            foreach($types as $type){
                echo "<option value='".$type['name']."'>".$type['name']."</option>";
            }
            echo "</select>";
        ?>
        <br>
        <input type="submit" name="submit" id="submit" value="Register" disabled>
    </form>
    <br>
</body>
</html>