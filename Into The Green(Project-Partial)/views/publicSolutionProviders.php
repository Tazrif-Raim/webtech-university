<?php
require '../controllers/solutionProviderController.php';
$solutionProviders = askAllSolutionProviders();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solution Providers</title>
</head>
<body>
    <?php require 'nav.php';?>
    <br>
    <h1>Solution Providers</h1><br>
    <?php foreach($solutionProviders as $solutionProvider){ ?>
        <hr>    
        <a href="publicSolutionProviderDetails.php?username=<?php echo $solutionProvider['username'] ?>"><?php echo $solutionProvider['organizationName'] ?></a>
        <?php echo $solutionProvider['organizationType'] ?> || 
            <?php 
                $specializations = askSpecializationsArrayByUsername($solutionProvider['username']);
                foreach($specializations as $specialization){
                    echo "| ".$specialization." | ";
                }
            ?>
        <hr>
    <?php } ?>

</body>
</html>