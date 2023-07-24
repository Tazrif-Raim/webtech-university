<?php
require '../controllers/solutionProvidersController.php';
session_start();
if(!isset($_SESSION['username'])){
    header('location:loginView.php');
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['submit'])){
        $filesName = $_FILES["fileToUpload"]["name"];
        $filesTmpName = $_FILES["fileToUpload"]["tmp_name"];
        $msg = tryImageUpload($filesName, $filesTmpName);
    }
}

$username = $_SESSION['username'];
$solutionProvider = askSolutionProviderByUserName($username);
$organizationName = $solutionProvider['organizationName'];
$organizationType = $solutionProvider['organizationType'];
$type = $solutionProvider['type'];
$logo = $solutionProvider['logo'];
$aboutMedia = $solutionProvider['aboutMedia'];
$shortAbout = $solutionProvider['shortAbout'];
$founded = $solutionProvider['founded'];
$employees = $solutionProvider['employees'];
$hq = $solutionProvider['hq'];
$story = $solutionProvider['story'];
$specializations = $solutionProvider['specializations'];
$organizationWebsite = $solutionProvider['organizationWebsite'];
$organizationAddress = $solutionProvider['organizationAddress'];
$mapsLink= $solutionProvider['mapsLink'];
$contactName= $solutionProvider['contactName'];
$contactEmail= $solutionProvider['contactEmail'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solution Provider</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
    <?php require 'solutionProviderLoginNavbar.php'?>
    <div class="container">
        <div class="sidebar">
            <?php require 'solutionProviderSidebar.php'?>
        </div>
        <div class="content">
        <fieldset>
                <legend>Profile Picture</legend>
                    <form action="solutionProviderLogo.php" method="post" enctype="multipart/form-data">
                    <br>
                    <input type="file" name="fileToUpload" id="fileToUpload">
                    <br>
                    <hr>
                    <input type="submit" value="Upload Image" name="submit">
                </form>
            </fieldset>
        </div>
    </div>
    <?php include 'footer.php';?>
</body>
</html>