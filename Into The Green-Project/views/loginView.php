<?php
require '../controllers/loginController.php';
if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    askLogin($username, $password);
}

if (!empty($_POST['remember'])) {
    setcookie("username", $_POST['username'], time()+(86400*30));
    setcookie("password", $_POST['password'], time()+(86400*30));	
} else {
    setcookie("username", "");
    setcookie("password", "");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in</title>
</head>
<body>
    <?php require 'navbar.php'?>
    <form action="loginView.php" method="post">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" value = "<?php if(isset($_COOKIE['username'])) {echo $_COOKIE['username'];}?>"><br>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" value = "<?php if(isset($_COOKIE['password'])) {echo $_COOKIE['password'];} ?>">
        <hr>
        <input id="remember" type="checkbox" name="remember" <?php if(isset($_COOKIE['username'])) {echo "checked";} ?>>
        <label for="remember">Remember Me</label><br>
        <input type="submit" name="submit" value="login">
    </form>
    <?php include 'footer.php'?>
</body>
</html>