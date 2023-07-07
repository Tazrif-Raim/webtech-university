<?php  
 $message = '';  
 $error = ''; 
 $nameErr = $emailErr = $dobErr = $genderErr = $unErr = $passErr = $cPassErr="";
$name = $email = $dob = $gender = $un = $pass = $cPass ="";
$isVerified = false; 
 if(isset($_POST["submit"]))  
 {  
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
        } else {
        $name = test_input($_POST["name"]);
        
        if(!preg_match("/^[a-zA-Z ]*$/",$name))
        {
            $nameErr = "Only letters, widespace allowed";
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
      if(empty($_POST["un"]))  
      {  
           $unErr = "Enter a username";
      } else{
        $un = test_input($_POST["un"]);
        if(!preg_match("/^[a-zA-Z0-9._-]*$/",$un))
        {
            $unErr = "Only letters, numbers, period, underscore and dash allowed";
        }
        else{
            $data = file_get_contents("data.json");  
            $data = json_decode($data, true);
            if(isset($data)){
                foreach($data as $user){
                    if($user["username"]==$un){
                        $unErr = "Username already exists";
                        break;
                    }
                }
            }
        }
      }
      if(empty($_POST["pass"]))  
      {  
        $passErr = "Enter a password"; 
      } else {
        $pass = test_input($_POST["pass"]);
        if(strlen($pass)<8){
            $passErr = "Password must be atleast 8 characters";
        }
        if(!preg_match("/[@,#,$,%]/",$pass)){
            $passErr = "Password must contain at least one of the special characters (@, #, $,%)";
        }
      }
      if(empty($_POST["cPass"]))  
      {  
        $cPassErr = "Confirm password can not be empty";
      } else{
        $cPass = test_input($_POST["cPass"]);
        if($cPass!=$pass){
            $cPassErr = "Confirm Password must match with Password";
        }
      }
      if (empty($_POST["gender"])) {
        $genderErr = "Gender is required";
      } else {
        $gender = test_input($_POST["gender"]);
      } 
      if(empty($_POST["dob"])){
        $dobErr = "Date of Birth is required";
      } else{
        $dob = test_input($_POST["dob"]);
        $maxYear = 2000;
        if(substr($dob,0,4)>$maxYear){
          $dobErr = "Date of Birth must be before 2001";
        }
      }

      if($nameErr=="" && $emailErr=="" && $unErr=="" && $passErr=="" && $cPassErr=="" && $genderErr=="" && $dobErr==""){
        $isVerified = true;
      }

      if($isVerified){
        if(file_exists('data.json'))  
        {  
            $current_data = file_get_contents('data.json');  
            $array_data = json_decode($current_data, true);  
            $new_data = array(  
                'name'     =>     $_POST['name'],  
                'e-mail'   =>     $_POST["email"],  
                'username' =>     $_POST["un"],
                'password' =>     $_POST["pass"],  
                'gender'   =>     $_POST["gender"],  
                'dob'      =>     $_POST["dob"]
            );  
            $array_data[] = $new_data;  
            $final_data = json_encode($array_data);  
            if(file_put_contents('data.json', $final_data))  
            {  
                $message = "Registration Complete";  
            }  
        }  
        else  
        {  
            $error = 'JSON File does not exists';  
        }
      }  
 }  

 function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
 ?>  
 <!DOCTYPE html>  
 <html>  
    <head>  
    <style>
        .error {color: #FF0000;}
    </style>
    <title>Registration</title>
    </head>  
      <body>  
        <?php require 'navbar.php'?>
        <br>
           <div>                   
                <form method="post">   
                     <span class = "error">* Required</span><br><br> 
                     <fieldset>
                        <legend><h2>Registration</h2></legend>
                        <label>Name:</label>
                        <input type="text" name="name" value="<?php echo $name;?>">
                        <span class="error">* <?php echo $nameErr;?></span><hr>  
                     <label>E-mail:</label>
                     <input type="text" name="email" value="<?php echo $email;?>">
                    <span class="error">* <?php echo $emailErr;?></span><hr />
                     <label>User Name:</label>
                     <input type="text" name = "un" value = "<?php echo $un?>"/>
                     <span class="error">* <?php echo $unErr;?></span><hr />
                     <label>Password:</label>
                     <input type="password" name = "pass" value="<?php echo $pass?>"/>
                     <span class="error">* <?php echo $passErr;?></span><hr />
                     <label>Confirm Password:</label>
                     <input type="password" name = "cPass" value="<?php echo $cPass?>"/>
                     <span class="error">* <?php echo $cPassErr;?></span><hr />

                    <fieldset>
                    <legend>Gender</legend>
                    <input type="radio" id="male" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">
                     <label for="male">Male</label>                     
                     <input type="radio" id="female" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">
                     <label for="female">Female</label>
                     <input type="radio" id="other" name="gender" <?php if (isset($gender) && $gender=="other") echo "checked";?> value="other">
                     <label for="other">Other</label>
                     <span class="error">* <?php echo $genderErr;?></span><hr>
                    </fieldset>
                    <hr>
                    <fieldset>
                     <legend>Date of Birth:</legend>
                     <input type="date" name="dob" value = "<?php echo $dob;?>"> 
                     <span class="error">* <?php echo $dobErr;?><hr>
                    </fieldset> 
                     <hr>
                     <input type="submit" name="submit" value="Submit"/> 
                     <input type="reset" name="reset" value="Reset"/><br />
                     </fieldset>
                     
                     <?php  
                     if(isset($message))  
                     {  
                        echo $message;  
                     }  
                     ?>  
                </form>
           </div>  
           <br />  
           <?php include 'footer.php'?>
      </body>  
 </html>  