<?php
require '../controllers/createNewAdminController.php';
session_start();
if(!isset($_SESSION["username"])){
    header("Location: login.php");
}
if($_SESSION["access"]!=="Admin"){
    header("Location: login.php");
}
$username = $_SESSION["username"];

$msg = '';
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if($_POST['submit'] == 'Register'){
        $data['firstName'] = $_POST['firstName'];
        $data['lastName'] = $_POST['lastName'];
        $data['username'] = $_POST['username'];
        $data['password'] = $_POST['password'];
        $data['confirmPassword'] = $_POST['confirmPassword'];
        $data['email'] = $_POST['email'];
        $data['type'] = "Admin";
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
    <title>Dashboard</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <?php require 'adminSidebar.php'?>
        </div>
        <div class="contentbar">
            <h1>Create New Admin</h1>
            <form action="createNewAdmin.php" method="post">
                <label for="firstName">First Name:</label><br>
                <input type="text" name="firstName" id="firstName">
                <br>
                <label for="lastName">Last Name:</label><br>
                <input type="text" name="lastName" id="lastName">
                <br>
                <label for="username">Username: </label><br>
                <input type="text" name="username" id="username">
                <br>
                <label for="password">Password: </label><br>
                <input type="password" name="password" id="password">
                <br>
                <label for="confirmPassword">Confirm Password: </label><br>
                <input type="password" name="confirmPassword" id="confirmPassword">
                <br>
                <label for="email">Email: </label><br>
                <input type="email" name="email" id="email">
                <br>
                <label for="type">Type: Admin</label><br>
                <input type="submit" name ="submit" value="Register">
                <input type="reset" name="reset" value="Reset">
            </form>
            <br>
            <?php echo $msg;?>
        </div>
    </div>
</body>
</html>