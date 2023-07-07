
<?php 
	if (!empty($_POST['remember'])) {
		setcookie("username", $_POST['un'], time()+(86400*30));
		setcookie("password", $_POST['pass'], time()+(86400*30));	
	} else {
        setcookie("username", "");
        setcookie("password", "");
    }
    
    session_start();
    $username = $password ="";
    if(isset($_POST['un']) && isset($_POST['pass'])){
        $username = $_POST['un'];
        $password = $_POST['pass'];
        $data = file_get_contents("data.json");  
        $data = json_decode($data, true);
        if(isset($data)){
            $flag = false;
            foreach($data as $user){
                if($user["username"]==$username && $user["password"]==$password){
                    $_SESSION['username'] = $username;
                    header("location:dashboard.php");
                    $flag = true;
                    break;
                }
            }
            if(!$flag) $msg = "username or password invalid";
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
    <?php require 'navbar.php'?>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <fieldset>
            <legend><h2>Login</h2></legend>
            <span>
            <?php
                if (isset($msg)) {
                    echo $msg;
                    echo "<br>";
                }
            ?>	 	
            </span>
            Username:
            <input type="text" name="un" value = "<?php if(isset($_COOKIE['username'])) {echo $_COOKIE['username'];}?>">
            <br>
            Password:
            <input type="password" name="pass" value = "<?php if(isset($_COOKIE['password'])) {echo $_COOKIE['password'];} ?>">
            <hr>
            <input id="remember" type="checkbox" name="remember" <?php if(isset($_COOKIE['username'])) {echo "checked";} ?>>
            <label for="remember">Remember Me</label><br>
            <input type="submit" name="login" value="Submit">
            <a href="forgotPassword.php">Forgot Password?</a>
            </fieldset>
        
    </form>
    <?php include 'footer.php'?>
</body>
</html>

