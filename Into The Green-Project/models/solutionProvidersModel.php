<?php
function getSolutionProvider($solutionProviderName){
    $data = file_get_contents("../data/solutionProviders.json");
    $data = json_decode($data, true);
    if(isset($data)){
        foreach($data as $solutionProvider){
            if($solutionProvider["organizationName"]==$solutionProviderName){
                return $solutionProvider;

            }
        }
    }
}

function getSolutionProviderByUserName($username){
    $data = file_get_contents("../data/solutionProviders.json");
    $data = json_decode($data, true);
    if(isset($data)){
        foreach($data as $solutionProvider){
            if($solutionProvider["username"]==$username){
                return $solutionProvider;

            }
        }
    }
}

function doesOrganizationNameExist($organizationName){
    $data = file_get_contents("../data/solutionProviders.json");
    $data = json_decode($data, true);
    if(isset($data)){
        foreach($data as $solutionProvider){
            if($solutionProvider["organizationName"]==$organizationName){
                return true;
            }
        }
    }
    return false;
}
function InsertOrganizationName($organizationName, $username){
    $data = file_get_contents("../data/solutionProviders.json");
    $data = json_decode($data, true);
    if(isset($data)){
        foreach($data as $solutionProvider){
            if($solutionProvider["username"]==$username){
                $organizationType = $solutionProvider["organizationType"];
                $type = $solutionProvider["type"];
                $logo = $solutionProvider["logo"];
                $aboutMedia = $solutionProvider["aboutMedia"];
                $shortAbout = $solutionProvider["shortAbout"];
                $founded = $solutionProvider["founded"];
                $employees = $solutionProvider["employees"];
                $hq = $solutionProvider["hq"];
                $story = $solutionProvider["story"];
                $specializations = $solutionProvider["specializations"];
                $organizationWebsite = $solutionProvider["organizationWebsite"];
                $organizationAddress = $solutionProvider["organizationAddress"];
                $mapsLink = $solutionProvider["mapsLink"];
                $contactName = $solutionProvider["contactName"];
                $contactEmail = $solutionProvider["contactEmail"];
                $userIndex = array_search($username, array_column($data, 'username'));
                if ($userIndex !== false) {
                    unset($data[$userIndex]);
                    $data = array_values($data);  
                    $new_data = array(  
                        'username'     =>     $username,
                        'organizationName'     =>     $organizationName,  
                        'organizationType'   =>     $organizationType,
                        'type'   =>     $type,
                        'logo' => $logo,
                        'aboutMedia' => $aboutMedia,
                        'shortAbout'=> $shortAbout,
                        'founded'=> $founded,
                        'employees'=> $employees,
                        'hq'=> $hq,
                        'story'=> $story,
                        'specializations'=> $specializations,
                        'organizationWebsite'=> $organizationWebsite,
                        'organizationAddress'=> $organizationAddress,
                        'mapsLink'=> $mapsLink,
                        'contactName'=> $contactName,
                        'contactEmail'=> $contactEmail
                    );  
                    $data[] = $new_data;  
                    $final_data = json_encode($data);
                    file_put_contents('../data/solutionProviders.json', $final_data);
                }
                break;
            }
        }
    }
}




function getSolutionProviders(){
    $data = file_get_contents("../data/solutionProviders.json");
    $data = json_decode($data, true);
    return $data;
}

function InsertLogo($filesName, $filesTmpName){
    $target_dir = "../users/assets/";
        $target_file = $target_dir . time() . basename($filesName);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        if($filesName == "") {
            $uploadOk = 0;
        } else {
            // Check if image file is a actual image or fake image
            
                $check = getimagesize($filesTmpName);
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
            if ($_FILES["fileToUpload"]["size"] > 4000000) {
                return "File size must be less than 4MB.";
                $uploadOk = 0;
            }
        
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
                if (move_uploaded_file($filesTmpName, $target_file)) {
                    //return "The file ". htmlspecialchars( basename( $filesName)). " has been uploaded.";
                    //push into json
                    $img = $target_file;
                    $username = $_SESSION['username'];
                    $data = file_get_contents("../data/solutionProviders.json");
                    $data = json_decode($data, true);
                    if(isset($data)){
                        foreach($data as $solutionProvider){
                            if($solutionProvider["username"]==$username){
                                $organizationName = $solutionProvider["organizationName"];
                                $organizationType = $solutionProvider["organizationType"];
                                $type = $solutionProvider["type"];
                                //$logo = $solutionProvider["logo"];
                                $aboutMedia = $solutionProvider["aboutMedia"];
                                $shortAbout = $solutionProvider["shortAbout"];
                                $founded = $solutionProvider["founded"];
                                $employees = $solutionProvider["employees"];
                                $hq = $solutionProvider["hq"];
                                $story = $solutionProvider["story"];
                                $specializations = $solutionProvider["specializations"];
                                $organizationWebsite = $solutionProvider["organizationWebsite"];
                                $organizationAddress = $solutionProvider["organizationAddress"];
                                $mapsLink = $solutionProvider["mapsLink"];
                                $contactName = $solutionProvider["contactName"];
                                $contactEmail = $solutionProvider["contactEmail"];
                                $userIndex = array_search($username, array_column($data, 'username'));
                                if ($userIndex !== false) {
                                    unset($data[$userIndex]);
                                    $data = array_values($data);  
                                    $new_data = array(  
                                        'username'     =>     $username,
                                        'organizationName'     =>     $organizationName,  
                                        'organizationType'   =>     $organizationType,
                                        'type'   =>     $type,
                                        'logo' => $img,
                                        'aboutMedia' => $aboutMedia,
                                        'shortAbout'=> $shortAbout,
                                        'founded'=> $founded,
                                        'employees'=> $employees,
                                        'hq'=> $hq,
                                        'story'=> $story,
                                        'specializations'=> $specializations,
                                        'organizationWebsite'=> $organizationWebsite,
                                        'organizationAddress'=> $organizationAddress,
                                        'mapsLink'=> $mapsLink,
                                        'contactName'=> $contactName,
                                        'contactEmail'=> $contactEmail
                                    );  
                                    $data[] = $new_data;  
                                    $final_data = json_encode($data);
                                    file_put_contents('../data/solutionProviders.json', $final_data);
                                }
                                break;
                            }
                        }
                    }
                }
            }
        }
    }

?>