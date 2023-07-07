<?php 

	session_start();
    $name = "";
	if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        $data = file_get_contents("data.json");
        $data = json_decode($data, true);
        if(isset($data)){
            foreach($data as $user){
                if($user["username"]==$username){
                    $name = $user["name"];
                    $pass = $user["password"];
                    break;
                }
            }
        }
    }else{
		header("location:login.php");
	}

    $curPassErr = $newPassErr = $reNewPassErr="";
    $curPass = $newPass = $reNewPass ="";
    $isVerified = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["curPass"])) {
            $curPassErr = "Current Password is required";
        } else {
            $curPass = test_input($_POST["curPass"]);
            if($curPass !== $pass){
                $curPassErr = "Current Password is not correct";
            }
        }
        
        if (empty($_POST["newPass"])) {
            $newPassErr = "New password is required";
        } else {
            $newPass = test_input($_POST["newPass"]);
            
            if($newPass === $pass){
                $newPassErr = "New Password should not be same as the Current Password";
            }
            if(strlen($newPass)<8){
                $newPassErr = "Password must be atleast 8 characters";
            }
            if(!preg_match("/[@,#,$,%]/",$newPass)){
                $newPassErr = "Password must contain at least one of the special characters (@, #, $,%)";
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

        if($isVerified){
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
                                'name'               =>     $name1,  
                                'e-mail'          =>     $email1,  
                                'username'     =>     $un1, 
                                'password'     =>     $newPass, 
                                'gender'     =>     $gender1,  
                                'dob'     =>     $dob1,
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
    <title>Change Password</title>
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
            <fieldset>
                <legend>Change Password</legend>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
                    Current Password: <input type="password" name="curPass" value="<?php echo $curPass;?>">
                    <span class="error"><?php echo $curPassErr;?></span>
                    <br><br>
                    New Password: <input type="password" name="newPass" value="<?php echo $newPass;?>">
                    <span class="error"><?php echo $newPassErr;?></span>
                    <br><br>
                    Retype New Password: <input type="password" name="reNewPass" value="<?php echo $reNewPass;?>">
                    <span class="error"><?php echo $reNewPassErr;?></span>
                    <hr>
                    <input type="submit" name="submit" value="Submit">  
                </form>
            </fieldset>
        </div>
    </div>
    <?php include 'footer.php'?>
</body>
</html>