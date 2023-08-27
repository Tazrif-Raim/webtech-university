<?php
require '../controllers/solutionController.php';

if($_SERVER['REQUEST_METHOD'] == "GET"){
    if(isset($_GET['submit'])){
        $search = $_GET['search'];
        $solutions = searchSolution($search);
        //header("location:../views/allSolutions.php");
    }else{
        $solutions = getAllPublishedSolutions();
    }
}else{
    $solutions = getAllPublishedSolutions();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solutions</title>
</head>
<body>
    <?php require 'nav.php';?>
    
    <br><h1>Solutions</h1><br>
    <form method="get" action="publicView.php">
        <h1>Search: </h1>
        <input type="text" name="search" value="<?php if(isset($_GET['submit'])){echo $_GET['search'];} ?>"/>
        <input type="submit" name="submit" value="Search"/><br><br>
    </form>
    <?php foreach ($solutions as $i => $solution): ?>
        <hr>
        <a href="publicPublishedSolution.php?id=<?php echo $solution['solutionID'] ?>"><h3><?php echo $solution['title'] ?></h3></a>
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