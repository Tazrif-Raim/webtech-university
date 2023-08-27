<?php
require '../controllers/solutionController.php';

$solutionID = $_GET['id'];
$solution = askSolutionDetailsById($solutionID);
$solutionProviderName = askSolutionProviderName($solution['username']);
$specializations = askSpecializations($solution);
$challenge = file_get_contents($solution['challenge']);
$solutionBody = file_get_contents($solution['solutionBody']);
$result = file_get_contents($solution['result']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solutions</title>
</head>
<body>
    <?php require 'nav.php'; ?><br>
    <h1><?php echo $solution['title'] ?></h1><br>
    <?php 
        foreach($specializations as $specialization){
            echo $specialization." ";
        }
    ?><br>
    <?php echo $solution['region'] ?><br>
    <?php echo $solution['publicationDate'] ?><br>
    <?php echo $solutionProviderName ?><br>
    <hr>
    <?php 
    if($solution['media']!=null){
        echo "<img src='".$solution['media']."' alt='' height='480' width='720'>";
    }
    ?>
    <hr>
    <h3>Challenge</h3>
    <?php echo $challenge ?>
    <br><br>
    <h3>Solution</h3>
    <?php echo $solutionBody ?>
    <br><br>
    <h3>Result</h3>
    <?php echo $result ?>
</body>
</html>