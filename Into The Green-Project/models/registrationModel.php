<?php
function doesUsernameExist($username){
    $data = file_get_contents("../data/users.json");
    $data = json_decode($data, true);
    if(isset($data)){
        foreach($data as $user){
            if($user["username"]==$username){
                return true;
            }
        }
    }
    return false;
}

function addUser($username, $password, $email, $type){
    if(file_exists('../data/users.json')){
        $data = file_get_contents("../data/users.json");  
        $data = json_decode($data, true);
        $new_data = array(  
            'username'     =>     $username,  
            'password'   =>     $password,
            'email'   =>     $email,
            'access'   =>     $type
        );
        $data[] = $new_data;
        $data = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents('../data/users.json', $data);
    }
    if($type=="solutionProvider"){
        if(file_exists('../data/solutionProviders.json')){
            $data = file_get_contents("../data/solutionProviders.json");  
            $data = json_decode($data, true);
            $new_data = array(  
                'username'     =>     $username,
                'organizationName'     =>     "",  
                'organizationType'   =>     "",
                'type'   =>     "solutionProvider",
                'logo' => "",
                'aboutMedia' => "",
                'shortAbout'=> "",
                'founded'=> "",
                'employees'=> "",
                'hq'=> "",
                'story'=> "",
                'specializations'=> "",
                'organizationWebsite'=> "",
                'organizationAddress'=> "",
                'mapsLink'=> "",
                'contactName'=> "",
                'contactEmail'=> ""
            );
            $data[] = $new_data;
            $data = json_encode($data, JSON_PRETTY_PRINT);
            file_put_contents('../data/solutionProviders.json', $data);
        }
    }
}
?>