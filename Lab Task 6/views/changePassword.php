<?php
require '../controllers/registrationController.php';

session_start();
if(!isset($_SESSION["username"])){
    header("Location: login.php");
}
$username = $_SESSION["username"];
$curPass = $newPass = $reNewPass = $msg ="";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $curPass = $_POST["curPass"];
    $newPass = $_POST["newPass"];
    $reNewPass = $_POST["reNewPass"];
    $msg = changePassword($username, $curPass, $newPass, $reNewPass);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <?php
                if($_SESSION["access"]=="Solution Provider"){
                    require 'solutionProviderSidebar.php';
                }
            ?>
        </div>
        <div class="content">

            <h1>Change Password</h1>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
                Current Password: <input type="password" name="curPass" value="<?php echo $curPass;?>">
                <br><br>
                New Password: <input type="password" name="newPass" value="<?php echo $newPass;?>">
                <br><br>
                Retype New Password: <input type="password" name="reNewPass" value="<?php echo $reNewPass;?>">
                <hr>
                <input type="submit" name="submit" value="Submit"> 
            </form>
            <?php echo $msg; ?>
        </div>
    </div>
</body>
</html>