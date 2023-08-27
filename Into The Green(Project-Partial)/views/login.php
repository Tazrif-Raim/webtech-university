<?php
require '../controllers/loginController.php';
$username = $password = $remember = $msg="";

if(isset($_COOKIE["username"])){
    $username=$_COOKIE["username"];
    $password=$_COOKIE["password"];
}

if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(isset($_POST["submit"])){
        $username=$_POST["username"];
        $password=$_POST["password"];
        if(isset($_POST["remember"])){
            $remember=$_POST["remember"];
        } else {
            $remember="";
        }
        $msg = validateLogin($username,$password, $remember);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <?php require 'nav.php';?>
    <br>
    <h1>Login</h1>
    <form action="login.php" method="post">
        <label for="username">Username:</label><br>
        <input type="text" name="username" id="username" value="<?php echo $username ?>" >
        <br>
        <label for="password">Password:</label><br>
        <input type="password" name="password" id="password" value="<?php echo $password ?>">
        <br>
        <input type="checkbox" name="remember" id="remember" value="Remember" <?php if(isset($_COOKIE["username"])){echo "checked";} ?>>
        <label for="remember">Remember Me</label><br><hr>
        <input type="submit" name ="submit" value="Login">
    </form>
    <br>
    <?php echo $msg; ?>
</body>
</html>