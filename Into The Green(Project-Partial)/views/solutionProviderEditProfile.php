<?php
require '../controllers/solutionProviderController.php';

session_start();
if(!isset($_SESSION["username"])){
    header("Location: login.php");
}
if($_SESSION["access"]!=="Solution Provider"){
    header("Location: login.php");
}
$msg = "";
$username = $_SESSION["username"];
$specializations = askAllSpecializations();
$setSpecializations = askSpecializationsArrayByUsername($username);
$user = askSolutionProvider($username);
$name = askName($username);
$user['firstName'] = $name['firstName'];
$user['lastName'] = $name['lastName'];
$user['email'] = $name['email'];
if($user['shortAbout']!=null){$user['shortAbout'] = file_get_contents($user['shortAbout']) /*or die("Unable to open file!")*/;}
else {$user['shortAbout'] = "";}
if($user['story']!=null){$user['story'] = file_get_contents($user['story']) /*or die("Unable to open file!")*/;}
else {$user['story'] = "";}
if($_SERVER['REQUEST_METHOD']=="POST"){
    $data['firstName'] = $_POST['firstName'];
    $data['lastName'] = $_POST['lastName'];
    $data['organizationName'] = $_POST['organizationName'];
    $data['organizationType'] = $_POST['organizationType'];
    $data['email'] = $_POST['email'];
    $data['shortAbout'] = $_POST['shortAbout'];
    $data['founded'] = $_POST['founded'];
    $data['employees'] = $_POST['employees'];
    $data['hq'] = $_POST['hq'];
    $data['story'] = $_POST['story'];
    $data['website'] = $_POST['website'];
    $data['address'] = $_POST['address'];
    $data['mapsLink'] = $_POST['mapsLink'];
    $data['contactName'] = $_POST['contactName'];
    $data['contactEmail'] = $_POST['contactEmail'];
    $data['specializations'] = isset($_POST['selected_specializations'])?$_POST['selected_specializations']:array();
    $data['username'] = $username;
    if(isset($_FILES['logo'])){
        $data['logo'] = $_FILES['logo']['name'];
        $data['logoTmp'] = $_FILES['logo']['tmp_name'];
    } else{
        $data['logo'] = "";
    }
    if(isset($_FILES['aboutMedia'])){
        $data['aboutMedia'] = $_FILES['aboutMedia']['name'];
        $data['aboutMediaTmp'] = $_FILES['aboutMedia']['tmp_name'];
    } else{
        $data['aboutMedia'] = "";
    }
    $msg = updateSolutionProvider($data);
    $user = askSolutionProvider($username);
    $name = askName($username);
    $user['firstName'] = $name['firstName'];
    $user['lastName'] = $name['lastName'];
    $user['email'] = $name['email'];
    if($user['shortAbout']!=null){$user['shortAbout'] = file_get_contents($user['shortAbout']) /*or die("Unable to open file!")*/;}
    else {$user['shortAbout'] = "";}
    if($user['story']!=null){$user['story'] = file_get_contents($user['story']) /*or die("Unable to open file!")*/;}
    else {$user['story'] = "";}
    $setSpecializations = askSpecializationsArrayByUsername($username);
}
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

            <h1>Edit Profile: Solution Provider</h1>

            Username: <?php echo $user['username']; ?><br> 
            <form action="solutionProviderEditProfile.php" method="post" enctype="multipart/form-data">
                First Name: <input type="text" name="firstName" id="firstName" value="<?php echo $user['firstName']; ?>"><br>
                Last Name: <input type="text" name="lastName" value="<?php echo $user['lastName']; ?>"><br>
                Organization Name: <input type="text" name="organizationName" value="<?php echo $user['organizationName']; ?>"><br>
                Organization Type: 
                <?php
                    $types = askAllOrganizationTypes();
                    echo "<select name='organizationType' id='organizationType'>";
                    foreach($types as $type){
                        echo "<option value='".$type['name']."'>".$type['name']."</option>";
                    }
                    echo "</select>";
                ?>
                <br>
                Specializations:
                <?php
                    foreach ($specializations as $specialization) {
                        echo '<label><input type="checkbox" name="selected_specializations[]" value="' . htmlspecialchars($specialization) . '" '; 
                        if(in_array($specialization, $setSpecializations)){echo "checked";} 
                        echo '>' . htmlspecialchars($specialization) . '</label><br>';
                    }
                ?>  
                Email: <input type="email" name="email" value="<?php echo $user['email']; ?>"><br>
                Logo: <br>
                <img src="<?php echo $user['logo']; ?>" alt="Logo" width="100px" height="100px"><br>
                <input type="file" name="logo" id="logo"><br>
                About Media: <br>
                <img src="<?php echo $user['aboutMedia']; ?>" alt="Media" width="720px" height="480px"><br>
                <input type="file" name="aboutMedia" id="aboutMedia"><br>
                Description: <br>
                <textarea name="shortAbout" id="shortAbout" cols="30" rows="10"><?php echo $user['shortAbout']; ?></textarea><br>
                Founded: <input type="date" name="founded" value="<?php echo $user['founded']; ?>"><br>
                Estimated Number of Employees: <input type="number" name="employees" value="<?php echo $user['employees']; ?>"><br>
                HQ: <input type="text" name="hq" value="<?php echo $user['hq']; ?>"><br>
                Story: <br>
                <textarea name="story" id="story" cols="30" rows="10"><?php echo $user['story']; ?></textarea><br>
                Website: <input type="text" name="website" value="<?php echo $user['website']; ?>"><br>
                Address: <input type="text" name="address" value="<?php echo $user['address']; ?>"><br>
                Maps Link: <input type="text" name="mapsLink" value="<?php echo $user['mapsLink']; ?>"><br>
                Contact Name: <input type="text" name="contactName" value="<?php echo $user['contactName']; ?>"><br>
                Contact Email: <input type="email" name="contactEmail" value="<?php echo $user['contactEmail']; ?>"><br>
                <input type="submit" name="submit" value="Update">
            </form>
            <p><?php echo $msg; ?></p>
        </div>
    </div>
</body>
</html>