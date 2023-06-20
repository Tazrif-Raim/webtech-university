<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<?php
// define variables and set to empty values
$nameErr = $passErr ="";
$name = $pass ="";
$isVerified = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    
    if(!preg_match("/^[a-zA-Z0-9.-_]*$/",$name))
    {
      $nameErr = "Alpha numeric characters, period, dash and underscore are allowed";
    }

    if(strlen($name)<2)
    {
      $nameErr = "Name must contain atleast two character";
    }

  }
  
  if (empty($_POST["pass"])) {
    $passErr = "pass is required";
  } else {
    $pass = test_input($_POST["pass"]);
    
    if(strlen($pass)<8)
    {
      $passErr = "Password must contain atleast eight character";
    }
    $atLeastOne = false;
    for($i=0;$i<strlen($pass);$i++){
      if($pass[$i]=='@' || $pass[$i]=='#' || $pass[$i]=='$' || $pass[$i]=='%'){
        $atLeastOne = true;
        break;
      }
    }
    if(!$atLeastOne){
      $passErr = "Password must contain at least one of the special characters (@, #, $, %)";
    }
  }

  

  if($nameErr == "" && $passErr == "")
  {
    $isVerified = true;
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>Lab Task 3: 1. Login</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  User Name: <input type="text" name="name" value="<?php echo $name;?>">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  Password: <input type="text" name="pass" value="<?php echo $pass;?>">
  <span class="error">* <?php echo $passErr;?></span>
  <hr>
  <input type="checkbox" name="rememberme" value="remember">Remember Me
  <br><br>
  <input type="submit" name="submit" value="Submit">  
  <a href="">Forget Password?</a>
</form>

<?php
if($isVerified){
  echo "<h2 style = color:#00FF00;>Validated Input:</h2>";
} else {
  echo "<h2>Your Input:</h2>";
}

echo $name;
echo "<br>";
echo $pass;
echo "<br>";
?>

</body>
</html>