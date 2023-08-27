<?php
require '../controllers/solutionProviderController.php';
$user = askSolutionProvider($_GET['username']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $user['organizationName']; ?></title>
</head>
<body>
    <?php require 'nav.php';?><br>
    <h1>Solution Provider</h1>
    <hr>
    Organization Name: <?php echo ($user['organizationName'])?$user['organizationName']:"" ?><br>
    Organization Type: <?php echo ($user['organizationType'])?$user['organizationType']:"" ?><br>
    Specializations: 
    <?php
    $specializations = askSpecializationsByUsername($_GET['username']);
        foreach($specializations as $specialization){
            echo " | ".$specialization['sector']." | ";
        }
    
        
    ?><br>
    Logo: <br>
    <img src="<?php echo $user['logo']; ?>" alt="Logo" width="100px" height="100px"><br>
    About Media: <br>
    <img src="<?php echo $user['aboutMedia']; ?>" alt="Logo" width="720px" height="480px"><br>
    Description:
    <p><?php echo file_exists($user['shortAbout'])?file_get_contents($user['shortAbout']):""  ?></p>
    Founded: <?php echo $user['founded']; ?><br>
    Employees: <?php echo $user['employees']; ?><br>
    HQ: <?php echo $user['hq']; ?><br>
    Story: <br>
    <p><?php echo file_exists($user['story'])?file_get_contents($user['story']):"" ; ?></p> 
    Website: <a href="<?php echo $user['website']; ?>" target="_blank">Website Link</a><br>
    Address: <?php echo $user['address']; ?><br>
    Maps Link: <a href="<?php echo $user['mapsLink']; ?>" target="_blank">Maps Link</a><br>
    Contact Name: <?php echo $user['contactName']; ?><br>
    Contact Email: <?php echo $user['contactEmail']; ?><br>
    

</body>
</html>