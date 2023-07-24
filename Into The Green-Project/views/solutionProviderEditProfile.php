<?php
require '../controllers/solutionProvidersController.php';
session_start();
if(!isset($_SESSION['username'])){
    header('location:loginView.php');
}

$username = $_SESSION['username'];

if(isset($_POST['submit'])){
    if(isset($_POST["organizationName"])){
        $organizationName = $_POST["organizationName"];
        if(!organizationNameExist($organizationName)){
            askInsertOrganizationName($organizationName, $username);
        }
    }
}

$solutionProvider = askSolutionProviderByUserName($username);
$organizationName = $solutionProvider['organizationName'];
$organizationType = $solutionProvider['organizationType'];
$type = $solutionProvider['type'];
$logo = $solutionProvider['logo'];
$aboutMedia = $solutionProvider['aboutMedia'];
$shortAbout = $solutionProvider['shortAbout'];
$founded = $solutionProvider['founded'];
$employees = $solutionProvider['employees'];
$hq = $solutionProvider['hq'];
$story = $solutionProvider['story'];
$specializations = $solutionProvider['specializations'];
$organizationWebsite = $solutionProvider['organizationWebsite'];
$organizationAddress = $solutionProvider['organizationAddress'];
$mapsLink= $solutionProvider['mapsLink'];
$contactName= $solutionProvider['contactName'];
$contactEmail= $solutionProvider['contactEmail'];
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
    <?php require 'solutionProviderLoginNavbar.php'?>
    <div class="container">
        <div class="sidebar">
            <?php require 'solutionProviderSidebar.php'?>
        </div>
        <div class="content">
            <form action="solutionProviderEditProfile.php" method="post">
                organizationName: <input type="text" name="organizationName" value="<?php echo $organizationName;?>"><br>
                organizationType: <input type="text" name="organizationType" value="<?php echo $organizationType;?>"><br>
                type: <input type="text" name="type" value="<?php echo $type;?>"><br>
                shortAbout: <textarea name="shortAbout" cols="30" rows="10"><?php echo $shortAbout;?></textarea><br>
                founded: <input type="text" name="founded" value="<?php echo $founded;?>"><br>
                employees: <input type="text" name="employees" value="<?php echo $employees;?>"><br>
                hq: <input type="text" name="hq" value="<?php echo $hq;?>"><br>
                story: <textarea name="story" cols="30" rows="100"><?php echo $story;?></textarea><br>
                organizationWebsiteLink: <input type="text" name="organizationWebsite" value="<?php echo $organizationWebsite;?>"><br>
                organizationAddress: <input type="text" name="organizationAddress" value="<?php echo $organizationAddress;?>"><br>
                mapsLink: <input type="text" name="mapsLink" value="<?php echo $mapsLink;?>"><br>
                contactName: <input type="text" name="contactName" value="<?php echo $contactName;?>"><br>
                contactEmail: <input type="text" name="contactEmail" value="<?php echo $contactEmail;?>"><br>
                <input type="submit" name="submit" value="Submit">
            </form>
            
        </div>
    </div>
    <?php include 'footer.php';?>
</body>
</html>