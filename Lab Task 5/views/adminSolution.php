<?php
require '../controllers/solutionController.php';
$solutionID = $_GET['id'];
$solution = askSolutionById($solutionID);
$solutionProviderName = askSolutionProviderName($solution['username']);
$specializations = askSpecializations($solution);
$challenge = file_get_contents($solution['challenge']);
$solutionBody = file_get_contents($solution['solutionBody']);
$result = file_get_contents($solution['result']);

// if($_SERVER['REQUEST_METHOD'] == "POST"){
//     $comment = $_POST['comment'];
//     if(isset($_POST['submit'])){
//         updateStatus($solution, $_POST['submit'], $comment);
//         //header("location:allSolutions.php");
//     }
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Solution</title>
</head>
<body>
<?php require 'nav.php'; ?>
<br>
<h1><?php echo $solution['title'] ?></h1>
<?php 
    foreach($specializations as $specialization){
        echo "| ".$specialization." | ";
    }
?><br>
<?php echo "| ".$solution['region']." | " ?><br>
<?php echo $solution['publicationDate'] ?><br>
<?php echo $solutionProviderName ?><br>
<hr>
<?php 
    if($solution['media']!=null){
        echo "<img src='".$solution['media']."' alt='' height='480' width='720'>";
    }
?>
<h3>Challenge</h3>
<?php echo $challenge ?>
<br><br>
<h3>Solution</h3>
<?php echo $solutionBody ?>
<br><br>
<h3>Result</h3>
<?php echo $result ?>
<hr>
<br><?php echo "Status: " . $solution['status'] ?><br>
<hr>
<form action="../controllers/adminSolutionAction.php" method="post">
    <input type="hidden" name="id" value="<?php echo $solution['solutionID'] ?>">
    <label for="comment">Short Comment:</label><br>
    <textarea name="comment" id="comment" cols="30" rows="10"></textarea><br>
    <input type="submit" name="submit" value="Approve">
    <input type="submit" name="submit" value="Revision">
    <input type="submit" name="submit" value="Reject">
</form>
    
</body>
</html>