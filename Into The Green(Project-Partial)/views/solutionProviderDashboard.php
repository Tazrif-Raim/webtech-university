<?php
require '../controllers/solutionProviderController.php';

session_start();
if(!isset($_SESSION["username"])){
    header("Location: login.php");
}
if($_SESSION["access"]!=="Solution Provider"){
    header("Location: login.php");
}
$username = $_SESSION["username"];
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
            <?php require 'solutionProviderSidebar.php'?>
        </div>
        <div class="contentbar">
            <h1>Welcome <?php echo $username; ?></h1>
        </div>
    </div>
</body>
</html>