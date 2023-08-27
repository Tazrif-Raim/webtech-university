<?php
require '../models/model.php';

session_start();
if(!isset($_SESSION["username"])){
    header("Location: login.php");
}
if($_SESSION["access"]!=="Admin"){
    header("Location: login.php");
}
$username = $_GET['username'];

deleteSolutionProvider($username);
deleteUser($username);
header("Location: ../views/allSolutionProviders.php");
?>