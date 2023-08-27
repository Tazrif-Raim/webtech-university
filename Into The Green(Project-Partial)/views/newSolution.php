<?php
require '../controllers/newSolutionController.php';
$solutionTypes = askSolutionTypes();
//var_dump($solutionTypes);

session_start();
if(!isset($_SESSION["username"])){
    header("Location: login.php");
}
if($_SESSION["access"]!=="Solution Provider"){
    header("Location: login.php");
}

if(isset($_POST['submit'])){
    if(isset($_POST['solutionType']) && isset($_POST['region']) && isset($_POST['title']) && isset($_POST['challenge']) && isset($_POST['solution']) && isset($_POST['result']) && isset($_POST["selected_specializations"])){
        $username = $_SESSION['username'];
        $solutionType = $_POST['solutionType'];
        $region = $_POST['region'];
        $title = $_POST['title'];
        $challenge = $_POST['challenge'];
        $solutionBody = $_POST['solution'];
        $result = $_POST['result'];
        $date = date("Y-m-d");
        $selectedSpecializations = $_POST["selected_specializations"];

        $data = [
            'username' => $username, // placeHolderUserNameFromSession
            'solutionType' => $solutionType,
            'region' => $region,
            'title' => $title,
            'challenge' => $challenge,
            'solutionBody' => $solutionBody,
            'result' => $result,
            'submissionDate' => $date,
            'selectedSpecializations' => $selectedSpecializations
        ];

        //var_dump($data);

        if(isset($_FILES['image'])){
            $data['fileName'] = $_FILES['image']['name'];
            $data['fileTmpName'] = $_FILES['image']['tmp_name'];
        }else{
            $data['fileName']="";
        }

        validateSolution($data);
        header("location:solutionProviderView.php");
    }else{
        $msg =  "Must fill all the fields except image";
    }   
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Solution</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <?php require 'solutionProviderSidebar.php'?>
        </div>
        <div class="contentbar">
            <h1>New Solution</h1>
            <form action="newSolution.php" method="post" enctype="multipart/form-data">
                <fieldset>
                    <legend>Submit New Solution</legend>
                    <label for="solutionType">Solution Type:</label><br>
                    <select name="solutionType" id="solutionType">
                        <?php
                            foreach($solutionTypes as $i => $solutionType){
                                echo "<option value='".$solutionType['name']."'>".$solutionType['name']."</option>";
                            }
                        ?>
                    </select><br>
                    <label for="region">Region:</label><br>
                    <input type="text" name="region" id="region"><br>
                    <label for="sector">Sector:</label><br>
                    <?php
                        $specializations = askAllSectors();
                        foreach ($specializations as $specialization) {
                            echo '<label><input type="checkbox" name="selected_specializations[]" value="' . htmlspecialchars($specialization) . '">' . htmlspecialchars($specialization) . '</label><br>';
                        }
                    ?>  
                    <label for="title">Title:</label><br>
                    <textarea name="title" id="title" cols="30" rows="10"></textarea><br>
                    <label for="image">Image:</label><br>
                    <input type="file" name="image" id="image"><br>
                    <label for="challenge">Challenge:</label><br>
                    <textarea name="challenge"  cols="30" rows="10"></textarea><br>
                    <label for="solution">Solution:</label><br>
                    <textarea name="solution"  cols="30" rows="10"></textarea><br>
                    <label for="result">Result:</label><br>
                    <textarea name="result"  cols="30" rows="10"></textarea><br>
                    <input type="submit" name="submit" value="Submit for admin approval">
                </fieldset>
            </form>
            <?php
                if(isset($msg)){
                    echo $msg;
                }
            ?>
        </div>
    </div>
    
</body>
</html>