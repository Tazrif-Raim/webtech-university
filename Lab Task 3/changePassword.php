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
$curPassErr = $newPassErr = $reNewPassErr="";
$curPass = $newPass = $reNewPass ="";
$isVerified = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["curPass"])) {
    $curPassErr = "Current Password is required";
  } else {
    $curPass = test_input($_POST["curPass"]);
  }
  
  if (empty($_POST["newPass"])) {
    $newPassErr = "New password is required";
  } else {
    $newPass = test_input($_POST["newPass"]);
    
    if($newPass === $curPass){
      $newPassErr = "New Password should not be same as the Current Password";
    }
  }

  if(empty($_POST["reNewPass"])){
    $reNewPassErr = "Retype New Password is required";
  } else {
    $reNewPass = test_input($_POST["reNewPass"]);
    
    if($newPass !== $reNewPass){
      $reNewPassErr = "New Password must match with the Retyped Password";
    }
  }
  

  if($curPassErr == "" && $newPassErr == "" && $reNewPassErr == "")
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

<h2>Lab Task 3: 2. Change Password</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Current Password: <input type="text" name="curPass" value="<?php echo $curPass;?>">
  <span class="error">* <?php echo $curPassErr;?></span>
  <br><br>
  New Password: <input type="text" name="newPass" value="<?php echo $newPass;?>">
  <span class="error">* <?php echo $newPassErr;?></span>
  <br><br>
  Retype New Password: <input type="text" name="reNewPass" value="<?php echo $reNewPass;?>">
  <span class="error">* <?php echo $reNewPassErr;?></span>
  <hr>
  <input type="submit" name="submit" value="Submit">  
</form>

<?php
if($isVerified){
  echo "<h2 style = color:#00FF00;>Validated Input:</h2>";
} else {
  echo "<h2>Your Input:</h2>";
}

echo $curPass;
echo "<br>";
echo $newPass;
echo "<br>";
echo $reNewPass;
echo "<br>";
?>

</body>
</html>