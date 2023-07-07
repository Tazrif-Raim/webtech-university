<?php 

	session_start();
    $name = $email = $gender = $dob = $img ="";
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
                    if(isset($user["profilePicture"])){
                        $img = $user["profilePicture"];
                    }
                    break;
                }
            }
        }
    }else{
		header("location:login.php");
	}

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Profile</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php require 'loginNavbar.php'?>
    <div class="container">
        <div class="sidebar">
            <?php require 'sidebar.php'?>
        </div>
        <div class="content">
            <fieldset>
                <legend>Profile</legend>
                <div style = "display: flex;">
                    <div style = "flex-basis: 50%; padding: 20px;">
                        Name: <?php echo $name; ?>
                        <hr>
                        Email: <?php echo $email; ?>
                        <hr>
                        Gender: <?php echo $gender; ?>
                        <hr>
                        Date of Birth: <?php echo $dob; ?>
                    </div>
                    <div style="flex-basis: 50%; padding: 20px;">
                    <img src="<?php if($img !=""){echo $img;} else{echo "profilePic.png";}?>" alt="profile_picture" height = 100 width = 100>
                    <br>
                    <a href="changeProfilePicture.php">Change</a>
                    </div> 
                </div>
                <hr>
                <a href="editProfile.php">Edit Profile</a>
            </fieldset>
        </div>
    </div>
    <?php include 'footer.php'?>
</body>
</html>