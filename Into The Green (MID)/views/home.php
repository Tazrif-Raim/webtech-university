<?php
$newscontent1 = $newscontent2 = $newscontent3 = $newsId1 = $newsId2 = $newsId3 = $newsMedia1 = $newsMedia2 = $newsMedia3 = $newstitle1 = $newstitle2 = $newstitle3 = "";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Into the Green</title>
</head>
<body>
    <?php require 'navbar.php'; ?>
    <div>
        <div>
            <h2>Your entry to the green transition</h2>
        </div>
        <div>
            <div>
                From challenges to solutions
                <a href="howWeWork.php">How we work</a>
            </div>
            <div>
                <a href="energyTransition.php">Energy transition</a><br>
                <a href="waterManagement.php">Water management</a><br>
                <a href="greenCities.php">Green cities</a><br>
                <a href="Circular economy">Circular economy</a>
            </div>
        </div>
        <hr>
        <!--space for news-->
        <div>
            <div>
                <img src="<?php echo $newsMedia1; ?>" alt="<?php echo $newstitle1; ?>"><br>
                <h3><?php echo $newstitle1; ?></h3>
                <p><?php echo $newscontent1; ?></p>
                <a href="news.php" name="<?php $newsId1?>">Read the news</a>
            </div>
            <div>
                <img src="<?php echo $newsMedia2; ?>" alt="<?php echo $newstitle2; ?>"><br>
                <h3><?php echo $newstitle2; ?></h3>
                <p><?php echo $newscontent2; ?></p>
                <a href="news.php" name="<?php $newsId2?>">Read the news</a>
            </div>
            <div>
                <img src="<?php echo $newsMedia3; ?>" alt="<?php echo $newstitle3; ?>"><br>
                <h3><?php echo $newstitle3; ?></h3>
                <p><?php echo $newscontent3; ?></p>
                <a href="news.php" name="<?php $newsId3?>">Read the news</a>
            </div>
        </div>
        <hr>
        <!--space for solutions and providers-->
        <div>
            <div>
                Explore Solutions
                <a href="solutionsHome.php">Explore Solutions</a>
            </div>
            <div>
                Find Solution Providers
                <a href="solutionProvidersHome.php">Find Your Solution Providers</a>
            </div>
        </div>
        <hr>
        <!--space for consider reading(more contents from all area)-->
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>