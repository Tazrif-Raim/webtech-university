<?php 

	session_start();
    $name = $img = "";
	if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        $data = file_get_contents("data.json");
        $data = json_decode($data, true);
        if(isset($data)){
            foreach($data as $user){
                if($user["username"]==$username){
                    $name = $user["name"];
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

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $target_dir = "uploads/";
        $target_file = $target_dir . time() . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        if($_FILES["fileToUpload"]["name"] == "") {
            $uploadOk = 0;
        } else {
            // Check if image file is a actual image or fake image
            if(isset($_POST["submit"])) {
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if($check !== false) {
                    //echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }
            }
        
            // Check if file already exists
            if (file_exists($target_file)) {
                echo "Sorry, file already exists. Please try again.";
                $uploadOk = 0;
            }
        
            // Check file size
            if ($_FILES["fileToUpload"]["size"] > 4000000) {
                echo "File size must be less than 4MB.";
                $uploadOk = 0;
            }
        
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                echo "Sorry, only JPG, JPEG, PNG files are allowed.";
                $uploadOk = 0;
            }
        
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    //echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
                    //push into json
                    $img = $target_file;
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
                                if(isset($user["profilePicture"])){
                                    $previmg = $user["profilePicture"];
                                    if(file_exists($previmg)){
                                        unlink($previmg);
                                    }
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
                                        'password'     =>     $pass1, 
                                        'gender'     =>     $gender1,  
                                        'dob'     =>     $dob1,
                                        'profilePicture'     =>     $img
                                    );  
                                    $data[] = $new_data;  
                                    $final_data = json_encode($data);
                                    file_put_contents('data.json', $final_data);
                                }
                                break;
                            }
                        }
                    }
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        }
    }

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Picture</title>
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
                <legend>Profile Picture</legend>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
                    <img src="<?php if($img !=""){echo $img;} else{echo "profilePic.png";}?>" alt="profile_picture" height = 100 width = 100>
                    <br>
                    <input type="file" name="fileToUpload" id="fileToUpload">
                    <br>
                    <hr>
                    <input type="submit" value="Upload Image" name="submit">
                </form>
            </fieldset>
        </div>
    </div>
    <?php include 'footer.php'?>
</body>
</html>