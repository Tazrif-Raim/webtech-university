<?php 

	session_start();
    $name = $email = $gender = $dob = "";
    $nameErr = $emailErr = $dobErr = $genderErr = "";
	if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        $data = file_get_contents("data.json");
        $data = json_decode($data, true);
        if(isset($data)){
            foreach($data as $user){
                if($user["username"]==$username){
                    $name = $user["name"];
                    $email = $user["e-mail"];
                    $gender = $user["gender"];
                    $dob = $user["dob"];
                    break;
                }
            }
        }
    }else{
		header("location:login.php");
	}

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
        if($nameErr == "" && $emailErr=="" && $genderErr=="" && $dobErr==""){
            $username = $_SESSION['username'];
            $data = file_get_contents("data.json");
            $data = json_decode($data, true);
            if(isset($data)){
                foreach($data as $user){
                    if($user["username"]==$username){
                        $name1 = $user["name"];
                        $email1 = $user["e-mail"];
                        $gender1 = $user["gender"];
                        $dob1 = $user["dob"];
                        $un1 = $user["username"];
                        $pass1 = $user["password"];
                        if(isset($user['profilePicture'])){
                            $img1 = $user["profilePicture"];
                        } else {
                            $img1 = "";
                        }
                        $userIndex = array_search($un1, array_column($data, 'username'));
                        if ($userIndex !== false) {
                            unset($data[$userIndex]);
                            $data = array_values($data); // Reset array keys
                            //$jsonData = json_encode($data, JSON_PRETTY_PRINT);
                            //file_put_contents('data.json', $jsonData);
                            //$current_data = file_get_contents('data.json');  
                            //$array_data = json_decode($current_data, true);  
                            $new_data = array(  
                                'name'               =>     $name,  
                                'e-mail'          =>     $email,  
                                'username'     =>     $un1, 
                                'password'     =>     $pass1, 
                                'gender'     =>     $gender,  
                                'dob'     =>     $dob,
                                'profilePicture'     =>     $img1
                            );  
                            $data[] = $new_data;  
                            $final_data = json_encode($data);
                            file_put_contents('data.json', $final_data);
                        }
                        break;
                    }
                }
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Profile</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .error {color: #FF0000;}
    </style>
</head>
<body>
    <?php require 'loginNavbar.php'?>
    <div class="container">
        <div class="sidebar">
            <?php require 'sidebar.php'?>
        </div>
        <div class="content">
            <form method = "post">
                <fieldset>
                    <legend><h2>Edit Profile</h2></legend>
                    <label>Name:</label>
                    <input type="text" name="name" value="<?php echo $name;?>">
                    <span class="error"><?php echo $nameErr;?></span><hr>  

                    <label>E-mail:</label>
                    <input type="text" name="email" value="<?php echo $email;?>">
                    <span class="error"><?php echo $emailErr;?></span><hr />

                    <input type="radio" id="male" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">
                    <label for="male">Male</label>                     
                    <input type="radio" id="female" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">
                    <label for="female">Female</label>
                    <input type="radio" id="other" name="gender" <?php if (isset($gender) && $gender=="other") echo "checked";?> value="other">
                    <label for="other">Other</label><hr>

                    <legend>Date of Birth:</legend>
                    <input type="date" name="dob" value = "<?php echo $dob;?>"> 
                    <span class="error"><?php echo $dobErr;?><hr>

                    <input type="submit" name="submit" value="Submit">
                </fieldset>
            </form>
        </div>
    </div>
    <?php include 'footer.php'?>
</body>
</html>