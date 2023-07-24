<?php
require '../controllers/contentRequestsController.php';
$id = $_GET["name"];
$solution = askContentFromId($id);
$type = $solution["type"];
$solutionType = $solution["solutionType"];
$title = $solution["title"];
$sectors = $solution["sectors"];
$media = $solution["media"];
$country = $solution["country"];
$city = $solution["city"];
$date = $solution["date"];
$solutionProviderName = $solution["solutionProviderName"];
$challenge = $solution["challenge"];
$sol = $solution["solution"];
$result = $solution["result"];
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
                echo '<hr>';
                echo '<div>';
                echo $type.'<br>';
                echo $solutionType.'<br>';
                foreach($sectors as $sector){
                    echo $sector."  ";
                }
                echo '<br>';
                echo '<img src="'.$media.'" alt="solution image" width="720px" height="480px"><br>';
                echo $title.'<br>';
                echo $date.'<br>';
                echo $city.', '.$country.'<br>';
                echo $solutionProviderName.'<br>';
                echo '<h2>Challenge</h2>';
                echo $challenge.'<br>';
                echo '<h2>Solution</h2>';
                echo $sol.'<br>';
                echo '<h2>Result</h2>';
                echo $result.'<br>';
                echo '</div>';
                echo '<hr>';
            ?>
            <form action="adminContentRequestsView.php" method="post">
                <label for="comment">Comment</label><br>
                <textarea name="comment" id="comment" cols="50" rows="15"></textarea><br>
                <input type="submit" id=<?php echo $id;?> name="accept" value="Accept">
                <input type="submit" id=<?php echo $id;?> name="revision" value="Send Back For Revision">
                <input type="submit" id=<?php echo $id;?> name="reject" value="Reject">
            </form>
        </div>
    </div>
    <?php include 'footer.php'?>
</body>
</html>