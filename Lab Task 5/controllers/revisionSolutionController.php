<?php
require '../controllers/solutionController.php';

if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST['submit'])){
        if(isset($_POST['solutionType']) && isset($_POST['region']) && isset($_POST['title']) && isset($_POST['challenge']) && isset($_POST['solution']) && isset($_POST['result']) && $_POST["selected_specializations"]!=null){
            $solutionID = $_POST['id'];
            $username = $_POST['username'];
            $solution = getSolutionOfUser($username, $solutionID);
            //var_dump($solution);
            $solutionType = $_POST['solutionType'];
            $region = $_POST['region'];
            $title = $_POST['title'];
            $challenge = $_POST['challenge'];
            $solutionBody = $_POST['solution'];
            $result = $_POST['result'];
            $date = date("Y-m-d");
            $selectedSpecializations = $_POST["selected_specializations"];

            $data = [
                'solutionID' => $solutionID,
                'username' => $username, // placeHolderUserNameFromSession
                'solutionType' => $solutionType,
                'region' => $region,
                'title' => $title,
                'challenge' => $challenge,
                'solutionBody' => $solutionBody,
                'result' => $result,
                'submissionDate' => $date,
                'selectedSpecializations' => $selectedSpecializations,
                'challengeFileName' => $solution['challenge'],
                'solutionBodyFileName' => $solution['solutionBody'],
                'resultFileName' => $solution['result']
            ];

            if(isset($_FILES['image'])){
                $data['fileName'] = $_FILES['image']['name'];
                $data['fileTmpName'] = $_FILES['image']['tmp_name'];
            }else{
                $data['fileName']="";
            }

            solutionUpdate($data);
        }
        header("location:../views/reviseSolution.php");
    }
    else{
        echo "Must fill all the fields except image";
    }
}
else{
    header("location:../views/reviseSolution.php");
}
?>