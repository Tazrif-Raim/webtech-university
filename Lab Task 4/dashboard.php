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
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php require 'loginNavbar.php'?>
    <div class="container">
        <div class="sidebar">
            <?php require 'sidebar.php'?>
        </div>
        <div class="content">
            <h1>Welcome <?php echo $name; ?></h1>
        </div>
    </div>
    <?php include 'footer.php'?>
</body>
</html>