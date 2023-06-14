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
$nameErr = $emailErr = $dobErr = $genderErr = $degreeErr = $bloodGroupErr ="";
$name = $email = $dob = $gender = $ssc = $hsc = $bsc = $msc = $bloodGroup = "";
$isVerified = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    
    if(!preg_match("/^[a-zA-Z.-]*$/",$name))
    {
      $nameErr = "Only letters, period and dash allowed";
    }

    if(str_word_count($name)<2)
    {
      $nameErr = "Name should contain atleast two words";
    }

    if(!preg_match("/^[a-zA-Z]*$/",$name[0]))
    {
      $nameErr = "Must start with a letter";
    }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }

  if(empty($_POST["dob"])){
    $dobErr = "Date of Birth is required";
  } else{
    $dob = test_input($_POST["dob"]);
    $minYear = 1953;
    $maxYear = 1998;
    if(substr($dob,0,4)<$minYear || substr($dob,0,4)>$maxYear){
      $dobErr = "Date of Birth must be within years 1953-1998";
    }
  }

  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }

  $totalDegree = 0;
  if(isset($_POST["ssc"]))
  {
    $totalDegree++;
    $ssc = test_input($_POST["ssc"]);
  }
  if(isset($_POST["hsc"]))
  {
    $totalDegree++;
    $hsc = test_input($_POST["hsc"]);
  }
  if(isset($_POST["bsc"]))
  {
    $totalDegree++;
    $bsc = test_input($_POST["bsc"]);
  }
  if(isset($_POST["msc"]))
  {
    $totalDegree++;
    $msc = test_input($_POST["msc"]);
  }
  if($totalDegree<2)
  {
    $degreeErr = "At least two of the degrees must be selected";
  }
  else
  {
    $degreeErr = "";
  }

  if(empty($_POST["bloodGroup"]))
  {
    $bloodGroupErr = "Blood Group is required";
  }
  else
  {
    $bloodGroup = test_input($_POST["bloodGroup"]);
  }

  if($nameErr == "" && $emailErr == "" && $dobErr == "" && $genderErr == "" && $degreeErr == "" && $bloodGroupErr == "")
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

<h2>Lab Task 2: PHP Form Validation</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Name: <input type="text" name="name" value="<?php echo $name;?>">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  E-mail: <input type="text" name="email" value="<?php echo $email;?>">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
  Date Of Birth: <input type="date" name="dob" value = "<?php echo $dob;?>">
  <span class="error">* <?php echo $dobErr;?></span>
  <br><br>
  Gender:
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">Female
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Male
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="other") echo "checked";?> value="other">Other  
  <span class="error">* <?php echo $genderErr;?></span>
  <br><br>
  Degree:
  <input type="checkbox" name="ssc" <?php if (isset($ssc) && $ssc=="ssc") echo "checked";?> value="ssc">SSC
  <input type="checkbox" name="hsc" <?php if (isset($hsc) && $hsc=="hsc") echo "checked";?> value="hsc">HSC
  <input type="checkbox" name="bsc" <?php if (isset($bsc) && $bsc=="bsc") echo "checked";?> value="bsc">BSc 
  <input type="checkbox" name="msc" <?php if (isset($msc) && $msc=="msc") echo "checked";?> value="msc">MSc  
  <span class="error">* <?php echo $degreeErr;?></span>
  <br><br>
  Blood Group:
  <select name="bloodGroup">
    <option></option>
    <option value="apos" <?php if (isset($bloodGroup) && $bloodGroup=="apos") echo "selected";?>>A+</option>
    <option value="aneg" <?php if (isset($bloodGroup) && $bloodGroup=="aneg") echo "selected";?>>A-</option>
    <option value="bpos" <?php if (isset($bloodGroup) && $bloodGroup=="bpos") echo "selected";?>>B+</option>
    <option value="bneg" <?php if (isset($bloodGroup) && $bloodGroup=="bneg") echo "selected";?>>B-</option>
    <option value="abpos" <?php if (isset($bloodGroup) && $bloodGroup=="abpos") echo "selected";?>>AB+</option>
    <option value="abneg" <?php if (isset($bloodGroup) && $bloodGroup=="abneg") echo "selected";?>>AB-</option>
    <option value="opos" <?php if (isset($bloodGroup) && $bloodGroup=="opos") echo "selected";?>>O+</option>
    <option value="oneg" <?php if (isset($bloodGroup) && $bloodGroup=="oneg") echo "selected";?>>O-</option>
  </select>
  <span class="error">* <?php echo $bloodGroupErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>

<?php
if($isVerified){
  echo "<h2 style = color:#00FF00;>Validated Input:</h2>";
} else {
  echo "<h2>Your Input:</h2>";
}

echo $name;
echo "<br>";
echo $email;
echo "<br>";
echo $dob;
echo "<br>";
echo $gender;
echo "<br>";
echo $ssc." ".$hsc." ".$bsc." ".$msc;
echo "<br>";
echo $bloodGroup;
?>

</body>
</html>