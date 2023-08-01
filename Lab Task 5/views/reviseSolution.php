<?php
require '../controllers/solutionController.php';

$username = "placeHolderUserNameFromSession";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revise Solution</title>
</head>
<body>
    <?php require 'nav.php';?>
    <br>
    <h1>Solutions For Revision</h1>
    <?php $solutions = getSolutionsForRevision($username);?>
    <?php foreach ($solutions as $i => $solution): ?>
        <hr>
        <a href="revisionSolution.php?id=<?php echo $solution['solutionID'] ?>"><h3><?php echo $solution['title'] ?></h3></a>
        <?php 
            $specializations = askSpecializations($solution);
            foreach($specializations as $specialization){
                echo $specialization." ";
            }
        ?><br>
        <?php echo $solution['region'] ?><br>
        <?php echo $solution['publicationDate'] ?><br> 
        <?php
            $solutionProviderName = askSolutionProviderName($solution['username']);
            echo $solutionProviderName;
        ?>
        <hr>
    <?php endforeach; ?>
    <br>
    <h1>Published Solutions</h1>
    <?php $solutions = getAllPublishedSolutionsOfUser($username);?>
    <?php foreach ($solutions as $i => $solution): ?>
        <hr>
        <a href="revisionSolution.php?id=<?php echo $solution['solutionID'] ?>"><h3><?php echo $solution['title'] ?></h3></a>
        <?php 
            $specializations = askSpecializations($solution);
            foreach($specializations as $specialization){
                echo $specialization." ";
            }
        ?><br>
        <?php echo $solution['region'] ?><br>
        <?php echo $solution['publicationDate'] ?><br> 
        <?php
            $solutionProviderName = askSolutionProviderName($solution['username']);
            echo $solutionProviderName;
        ?>
        <hr>
    <?php endforeach; ?>
</body>
</html>