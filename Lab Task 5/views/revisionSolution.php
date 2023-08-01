<?php
require '../controllers/solutionController.php';

$solutionID = $_GET['id'];
$solutionTypes = askSolutionTypes();
$username = "placeHolderUserNameFromSession";
$solution = getSolutionOfUser($username, $solutionID);
$solutionProviderName = askSolutionProviderName($solution['username']);
$specializations = askSpecializations($solution);
$challenge = file_get_contents($solution['challenge']);
$solutionBody = file_get_contents($solution['solutionBody']);
$result = file_get_contents($solution['result']);
$comment = $solution['comment'];
$status = $solution['status'];

// if(isset($_POST['submit'])){
//     if(isset($_POST['solutionType']) && isset($_POST['region']) && isset($_POST['title']) && isset($_POST['challenge']) && isset($_POST['solution']) && isset($_POST['result']) && isset($_POST["selected_specializations"])){
//         $username = "placeHolderUserNameFromSession";
//         $solutionType = $_POST['solutionType'];
//         $region = $_POST['region'];
//         $title = $_POST['title'];
//         $challenge = $_POST['challenge'];
//         $solutionBody = $_POST['solution'];
//         $result = $_POST['result'];
//         $date = date("Y-m-d");
//         $selectedSpecializations = $_POST["selected_specializations"];

//         $data = [
//             'solutionID' => $solutionID,
//             'username' => $username, // placeHolderUserNameFromSession
//             'solutionType' => $solutionType,
//             'region' => $region,
//             'title' => $title,
//             'challenge' => $challenge,
//             'solutionBody' => $solutionBody,
//             'result' => $result,
//             'submissionDate' => $date,
//             'selectedSpecializations' => $selectedSpecializations,
//             'challengeFileName' => $solution['challenge'],
//             'solutionBodyFileName' => $solution['solutionBody'],
//             'resultFileName' => $solution['result']
//         ];

//         if(isset($_FILES['image'])){
//             $data['fileName'] = $_FILES['image']['name'];
//             $data['fileTmpName'] = $_FILES['image']['tmp_name'];
//         }else{
//             $data['fileName']="";
//         }

//         solutionUpdate($data);
//         header("location:solutionProviderView.php");
//     }else{
//         echo "Must fill all the fields except image";
//     }   
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solution Revision</title>
</head>
<body>
    <?php require 'nav.php'; ?>
    <br>
    <h1>Revision Solution</h1>
    <form action="../controllers/revisionSolutionController.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $solutionID ?>">
        <input type="hidden" name="username" value="<?php echo $username ?>">
        <fieldset>
            <legend>Revision Solution</legend>
            <label for="comment">Comment:</label><br>
            <textarea name="comment" id="comment" cols="30" rows="10" disabled><?php echo $comment; ?></textarea><br>
            <label for="solutionType">Solution Type:</label><br>
            <select name="solutionType" id="solutionType">
                <?php
                    foreach($solutionTypes as $i => $solutionType){
                        echo "<option value='".$solutionType['name']."'>".$solutionType['name']."</option>";
                    }
                ?>
            </select><br>
            <label for="region">Region:</label><br>
            <input type="text" name="region" id="region" value="<?php echo $solution['region']; ?>"><br>
            <label for="sector">Sector:</label><br>
            <?php
                $specializations = askAllSectors();
                foreach ($specializations as $specialization) {
                    echo '<label><input type="checkbox" name="selected_specializations[]" value="' . htmlspecialchars($specialization) . '">' . htmlspecialchars($specialization) . '</label><br>';
                }
            ?>  
            <label for="title">Title:</label><br>
            <textarea name="title" id="title" cols="30" rows="10"><?php echo $solution['title']; ?></textarea><br>
            <?php 
                if($solution['media']!=null){
                    echo "<img src='".$solution['media']."' alt='' height='480' width='720'><br>";
                }
            ?>
            <label for="image">Image:</label><br>
            <input type="file" name="image" id="image"><br>
            <label for="challenge">Challenge:</label><br>
            <textarea name="challenge" cols="30" rows="10"><?php echo $challenge; ?></textarea><br>
            <label for="solution">Solution:</label><br>
            <textarea name="solution"  cols="30" rows="10"><?php echo $solutionBody; ?></textarea><br>
            <label for="result">Result:</label><br>
            <textarea name="result" cols="30" rows="10"><?php echo $result; ?></textarea><br>

            <input type="submit" name="submit" value="Submit for admin approval">
        </fieldset>
    </form>
</body>
</html>