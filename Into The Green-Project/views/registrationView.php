<?php
require '../controllers/registrationController.php';
$msg="";
if(isset($_POST['submit'])){
    if(!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['confirmPassword']) && !empty($_POST['email']) && !empty($_POST['type'])){
        $msg = validateUser($_POST['username'], $_POST['password'], $_POST['confirmPassword'], $_POST['email'], $_POST['type']);
    }
    else{
        $msg = "Fill up all the fields";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
</head>
<body>
    <?php require 'navbar.php';?>
    <?php
        if(isset($msg)){
            echo $msg."<br>";
        }
    ?>
    <form action="registrationView.php" method="post">
        <label for="username">Username</label>
        <input type="text" name="username" id="username"><br>
        <label for="password">Password</label>
        <input type="password" name="password" id="password"><br>
        <label for="confirmPassword">Confirm Password</label>
        <input type="password" name="confirmPassword" id="confirmPassword"><br>
        <label for="email">Email</label>
        <input type="email" name="email" id="email"><br>
        <label for="type">Type</label>
        <select name="type" id="type">
            <option value="solutionProvider">Solution Provider</option>
            <option value="Journalist">Journalist</option>
            <option value="researcher">Researcher</option>
        </select><br>
        <input type="submit" name="submit" value="Sign Up">
    </form>
    <?php include 'footer.php';?>
</body>
</html>