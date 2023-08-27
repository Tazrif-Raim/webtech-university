<?php
require '../controllers/solutionProviderController.php';

session_start();
if(!isset($_SESSION["username"])){
    header("Location: login.php");
}
if($_SESSION["access"]!=="Solution Provider"){
    header("Location: login.php");
}
$username = $_SESSION["username"];
$user = askSolutionProvider($username);
$name = askName($username);
$specializations = askSpecializationsByUsername($username);
$user['firstName'] = $name['firstName'];
$user['lastName'] = $name['lastName'];
$user['email'] = $name['email'];
if($user['shortAbout']!=null){$user['shortAbout'] = file_get_contents($user['shortAbout']) /*or die("Unable to open file!")*/;}
else {$user['shortAbout'] = "";}
if($user['story']!=null){$user['story'] = file_get_contents($user['story']) /*or die("Unable to open file!")*/;}
else {$user['story'] = "";}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solution Provider</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <?php require 'solutionProviderSidebar.php'?>
        </div>
        <div class="contentbar">

            <h1>View Profile: Solution Provider</h1>

            Username: <?php echo $user['username']; ?><br>
            Name: <?php echo $user['firstName']." ".$user['lastName']; ?><br>
            Organization Name: <?php echo $user['organizationName']; ?><br>
            Organization Type: <?php echo $user['organizationType']; ?><br>
            Specializations: 
            <?php
                foreach($specializations as $specialization){
                    echo " | ".$specialization['sector']." | ";
                }
            ?><br>
            Email: <?php echo $user['email']; ?><br>
            Logo: <br>
            <img src="<?php echo $user['logo']; ?>" alt="Logo" width="100px" height="100px"><br>
            About Media: <br>
            <img src="<?php echo $user['aboutMedia']; ?>" alt="Logo" width="720px" height="480px"><br>
            Description:
            <p><?php echo $user['shortAbout'] ?></p>
            Founded: <?php echo $user['founded']; ?><br>
            Employees: <?php echo $user['employees']; ?><br>
            HQ: <?php echo $user['hq']; ?><br>
            Story: <br>
            <p><?php echo $user['story']; ?></p> 
            Website: <a href="<?php echo $user['website']; ?>" target="_blank">Website Link</a><br>
            Address: <?php echo $user['address']; ?><br>
            Maps Link: <a href="<?php echo $user['mapsLink']; ?>" target="_blank">Maps Link</a><br>
            Contact Name: <?php echo $user['contactName']; ?><br>
            Contact Email: <?php echo $user['contactEmail']; ?><br>
        </div>
    </div>
</body>
</html>