<?php
require_once '../models/model.php';

function askSolutionTypes(){
    return getSolutionTypes();
}

function validateSolution($data){
    // Step 2: Open the file in write mode
    $time = time();
    $solutionID=$data['username'].$time;
    $data['solutionID'] = $solutionID;
    $filename = "../uploads/"; // Change this to the desired filename or path
    $filename = $filename .$solutionID ."-challenge-".$time. ".txt";
    $file = fopen($filename, "w") or die("Unable to open file!");

    // Step 3: Write the content and close the file
    fwrite($file, $data["challenge"]);
    $data["challenge"] = $filename;
    fclose($file);
    
    $filename = "../uploads/"; // Change this to the desired filename or path
    $filename = $filename . $solutionID ."-solution-".$time. ".txt";
    $file = fopen($filename, "w") or die("Unable to open file!");

    // Step 3: Write the content and close the file
    fwrite($file, $data["solutionBody"]);
    $data["solutionBody"] = $filename;
    fclose($file);

    $filename = "../uploads/"; // Change this to the desired filename or path
    $filename = $filename . $solutionID ."-result-".$time. ".txt";
    $file = fopen($filename, "w") or die("Unable to open file!");

    // Step 3: Write the content and close the file
    fwrite($file, $data["result"]);
    $data["result"] = $filename;
    fclose($file);

    $addSolution = addSolution($data);
    $selectedSpecializations = $data['selectedSpecializations'];
    foreach($selectedSpecializations as $specialization){
        $d['type'] = "solution";
        $d['id'] = $solutionID;
        $d['sector'] = $specialization;
        addSpecialization($d);
    }

    if($data['fileName'] != ""){
        UploadFile($data['fileName'], $data['fileTmpName'], $solutionID);
    }

    return $addSolution;
}

function UploadFile($fileName, $fileTmpName, $solutionId){
    $target_dir = "../uploads/";
    $target_file = $target_dir . $solutionId ."-". time() . basename($fileName);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    if($fileName == "") {
        $uploadOk = 0;
    } else {
        // Check if image file is a actual image or fake image
        
            $check = getimagesize($fileTmpName);
            if($check !== false) {
                //return "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                return "File is not an image.";
                $uploadOk = 0;
            }
        
    
        // Check if file already exists
        if (file_exists($target_file)) {
            return "Sorry, file already exists. Please try again.";
            $uploadOk = 0;
        }
    
        // Check file size
        /*if ($_FILES["fileToUpload"]["size"] > 4000000) {
            return "File size must be less than 4MB.";
            $uploadOk = 0;
        }*/
    
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            return "Sorry, only JPG, JPEG, PNG files are allowed.";
            $uploadOk = 0;
        }
    
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            return "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($fileTmpName, $target_file)) {
                uploadImage($target_file, $solutionId);
                return "The file has been uploaded";
            } else {
                return "Sorry, there was an error uploading your file.";
            }
        }
    }
}

function askAllSectors(){
    $rows = getAllSectors();
    $specializations = array();
    foreach($rows as $row){
        $specializations[] = $row['name'];
    }
    return $specializations;
}
?>