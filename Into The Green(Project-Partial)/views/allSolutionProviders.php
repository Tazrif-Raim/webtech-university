<?php
require '../controllers/solutionProviderController.php';
session_start();
if(!isset($_SESSION["username"])){
    header("Location: login.php");
}
if($_SESSION["access"]!=="Admin"){
    header("Location: login.php");
}
$username = $_SESSION["username"];
$solutionProviders = askAllSolutionProviders();
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
            <h1>Solution Providers</h1>
            <table border="solid 2px">
                <tr>
                    <th>Username</th>
                    <th>Organization Name</th>
                    <th>Organization Type</th>
                    <th>Specializations</th>
                    <th>Actions</th>
                </tr>
                <?php foreach($solutionProviders as $solutionProvider){ ?>
                <tr>
                    <td><?php echo $solutionProvider['username'] ?></td>
                    <td><a href="solutionProviderDetails.php?username=<?php echo $solutionProvider['username'] ?>"><?php echo $solutionProvider['organizationName'] ?></a></td>
                    <td><?php echo $solutionProvider['organizationType'] ?></td>
                    <td>
                        <?php 
                            $specializations = askSpecializationsArrayByUsername($solutionProvider['username']);
                            foreach($specializations as $specialization){
                                echo "| ".$specialization." | ";
                            }
                        ?>
                    </td>
                    <td>
                        <a href="../controllers/deleteSolutionProviderController.php?username=<?php echo $solutionProvider['username'] ?>">Delete</a>
                    </td>
                </tr>
                <?php } ?>
        </div>
    </div>
</body>
</html>