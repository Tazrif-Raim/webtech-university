<?php
require '../controllers/contentRequestsController.php';

session_start();
if(!isset($_SESSION['username'])){
    header('location:loginView.php');
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST["name"]) && isset($_POST["Id"])){
        $buttonName = $_POST["name"];
        $buttonId = $_POST["Id"];
        completeContentRequest($buttonName, $buttonId);
    }
}
$contentRequests = askAllContentRequests();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
    <?php require 'adminLoginNavbar.php'?>
    <div class="container">
        <div class="sidebar">
            <?php require 'sidebar.php'?>
        </div>
        <div class="content">
            <?php
                if($contentRequests == null){
                    echo "No content requests";
                }
                else{
                    foreach($contentRequests as $contentRequest){
                        $type = $contentRequest["type"];
                        $redirectLink = getTypeRedirectLink($type);
                        $title = $contentRequest["title"];
                        $sectors = $contentRequest["sectors"];
                        $Id = $contentRequest["Id"];
                        echo '<hr>';
                        echo '<div>';
                        echo $type.'<br>';
                        foreach($sectors as $sector){
                            echo $sector."  ";
                        }
                        echo '<br>';
                        echo '<a href="'.$redirectLink.'?name='.$Id.'">'.$title.'</a><br>';
                        echo '</div>';
                        echo '<hr>';
                    }
                }
                
            ?>
        </div>
    </div>
    <?php include 'footer.php'?>
</body>
</html>