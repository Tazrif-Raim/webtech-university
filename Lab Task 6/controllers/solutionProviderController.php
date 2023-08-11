<?php
require '../models/model.php';

function askSolutionProvider($username){
    return getSolutionProvider($username);
}

function askName($username){
    return getName($username);
}

function askSpecializationsByUsername($username){
    return getSpecializationsByUserName($username);
}

function askAllSpecializations(){
    $data = getAllSpecializations();
    $specializations = array();
    foreach($data as $d){
        array_push($specializations, $d['name']);
    }
    return $specializations;
}

function askAllOrganizationTypes(){
    return getAllOrganizationTypes();
}

function askSpecializationsArrayByUsername($username){
    $data = getSpecializationsByUserName($username);
    $specializations = array();
    foreach($data as $d){
        array_push($specializations, $d['sector']);
    }
    return $specializations;
}

function updateSolutionProvider($data){
    $check = true;
    $msg = "";
    if($data['firstName'] == ""){
        $msg = "First Name cannot be Empty";
        $check =false;
    }
    if(!preg_match("/^[a-zA-Z ]*$/",test_input($data['firstName']))){
        $msg = "Only letters and white space allowed in First Name";
        $check = false;
    }
    if($check){
        updateFirstName($data['username'], $data['firstName']);
    }
    $check =true;
    if($data['lastName'] == ""){
        $msg = "Last Name cannot be Empty";
        $check = false;
    }
    if(!preg_match("/^[a-zA-Z ]*$/",test_input($data['lastName']))){
        $msg = "Only letters and white space allowed in Last Name";
        $check = false;
    }
    if($check){
        updateLastName($data['username'], $data['lastName']);
    }
    $check = true;
    if($data['organizationName'] == ""){
        $msg = "Organization Name cannot be Empty";
        $check = false;
    }
    if($check){
        updateOrganizationName($data['username'], $data['organizationName']);
    }
    if(doesOrganizationTypeExist($data['organizationType'])){
        updateOrganizationType($data['username'], $data['organizationType']);
    }
    $check = true;
    if(!filter_var(test_input($data['email']), FILTER_VALIDATE_EMAIL)){
        $msg = "Email must be a valid email address";
        $check = false;
    }
    if($check){
        updateEmail($data['username'], $data['email']);
    }

    $filename = "../uploads/";
    $filename = $filename .$data['username']."shortAbout". ".txt";
    $file = fopen($filename, "w") or die("Unable to open file!");

    fwrite($file, $data["shortAbout"]);
    $data["shortAbout"] = $filename;
    fclose($file);
    updateShortAbout($data['username'], $data['shortAbout']);
    $check = true;
    if($data['founded']>date("Y-m-d")){
        $msg = "Founded date cannot be in the Future";
        $check = false;
    }
    if($check){
        updateFounded($data['username'], $data['founded']);
    }
    $check = true;
    if($data['employees']<0){
        $msg = "Employees cannot be Negative";
        $check = false;
    }
    if($check){
        updateEmployees($data['username'], $data['employees']);
    }
    $check = true;
    if($data['hq'] == ""){
        $msg = "Headquarters cannot be Empty";
        $check = false;
    }
    if($check){
        updateHq($data['username'], $data['hq']);
    }
    $filename = "../uploads/";
    $filename = $filename .$data['username']."story". ".txt";
    $file = fopen($filename, "w") or die("Unable to open file!");

    fwrite($file, $data["story"]);
    $data["story"] = $filename;
    fclose($file);
    updateStory($data['username'], $data['story']);
    updateWebsite($data['username'], $data['website']);
    $check = true;
    if($data['address'] == ""){
        $msg = "Address cannot be Empty";
        $check = false;
    }
    if($check){
        updateAddress($data['username'], $data['address']);
    }
    updateMapsLink($data['username'], $data['mapsLink']);
    $check = true;
    if(!preg_match("/^[a-zA-Z ]*$/",test_input($data['contactName']))){
        $msg = "Only letters and white space allowed in Contact Name";
        $check = false;
    }
    if($check){
        updateContactName($data['username'], $data['contactName']);
    }
    $check = true;
    if(!filter_var(test_input($data['contactEmail']), FILTER_VALIDATE_EMAIL)){
        $msg = "Contact Email must be a valid email address";
        $check = false;
    }
    if($check){
        updateContactEmail($data['username'], $data['contactEmail']);
    }
    if(count($data['specializations'])>0){
        deleteSpecializations($data['username']);
        foreach($data['specializations'] as $specialization){
            insertSpecialization($data['username'], $specialization);
        }
    }
    $user = getSolutionProvider($data['username']);
    if($data['logo']!=""){
        $target_file = UploadFile($data['logo'], $data['logoTmp'], $data['username']);
        if(substr($target_file, 0, 11)=="../uploads/"){
            if($user['logo']!=""){
                unlink($user['logo']);
            }
            uploadLogo($data['username'], $target_file);
        }
    }
    if($data['aboutMedia']!=""){
        $target_file = UploadFile($data['aboutMedia'], $data['aboutMediaTmp'], $data['username']);
        if(substr($target_file, 0, 11)=="../uploads/"){
            if($user['aboutMedia']!=""){
                unlink($user['aboutMedia']);
            }
            uploadAboutMedia($data['username'], $target_file);
        }
    }
    return $msg;
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
                return $target_file;
            } else {
                return "Sorry, there was an error uploading your file.";
            }
        }
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>