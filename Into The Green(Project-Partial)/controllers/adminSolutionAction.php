<?php
require '../controllers/solutionController.php';

if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST['submit'])){
        updateStatus(askSolutionById($_POST['id']), $_POST['submit'], $_POST['comment']);
        header("location:../views/allSolutions.php");
    }
}
else{
    header("location:../views/allSolutions.php");
}
?>