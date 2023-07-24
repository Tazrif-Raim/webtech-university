<?php
require '../controllers/solutionProvidersController.php';
$solutionProviders = askSolutionProviders();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solution Providers</title>
</head>
<body>
    <?php require 'navbar.php'; ?>
    <div>
        <h2>Solution Providers</h2>
        <p>Connect with companies, policy makers and researchers who can solve your challenges</p>
        <div>
            <?php
                foreach($solutionProviders as $solutionProvider){
                    if($solutionProvider["organizationName"] != ""){
                        $name = $solutionProvider["organizationName"];
                        $logo = $solutionProvider["logo"];
                        $shortAbout = $solutionProvider["shortAbout"];
                        $specializations = $solutionProvider["specializations"];
                        $organizationType = $solutionProvider["organizationType"];
                        echo '<hr>';
                        echo '<div>';
                        echo '<img src="'.$logo.'" alt = "logo" height="100" width="100"><br>';
                        echo $organizationType.'<br>';
                        if($specializations != null){
                            echo 'Specializations: ';
                            foreach($specializations as $specialization){
                                echo $specialization."  ";
                            }
                            echo '<br>';
                        }
                        echo '<br>';
                        echo '<a href="solutionProvider.php?name='.$name.'">'.$name.'</a><br>';
                        echo $shortAbout.'<br>';
                        echo '</div>';
                    }
                }
            ?>
        </div>
    </div>
    <?php include 'footer.php'?>
</body>
</html>