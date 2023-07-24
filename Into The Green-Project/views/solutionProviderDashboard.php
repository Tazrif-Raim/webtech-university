<?php
require '../controllers/solutionProvidersController.php';
session_start();
if(!isset($_SESSION['username'])){
    header('location:loginView.php');
}

$username = $_SESSION['username'];
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
            organizationName: <?php echo $organizationName;?><br>
            organizationType: <?php echo $organizationType;?><br>
            type: <?php echo $type;?><br>
            logo: <img src="<?php echo $logo;?>" alt="" height="100" width="100"><br>
            aboutMedia: <?php echo $aboutMedia;?><br>
            shortAbout: <?php echo $shortAbout;?><br> 
            founded: <?php echo $founded;?><br>
            employees: <?php echo $employees;?><br>
            hq: <?php echo $hq;?><br>
            story: <?php echo $story;?><br>
            specializations: <?php echo $specializations;?><br>
            organizationWebsite: <?php echo $organizationWebsite;?><br>
            organizationAddress: <?php echo $organizationAddress;?><br>
            mapsLink: <a href="<?php echo $mapsLink;?>" target="_blank">Location on Map</a><br>
            contactName: <?php echo $contactName;?><br>
            contactEmail: <?php echo $contactEmail;?><br>
        </div>
    </div>
    <?php include 'footer.php';?>
</body>
</html>