<?php
function login($username, $password){
    if(isset($username) && isset($password)){
        if(file_exists('../data/users.json')){
            $data = file_get_contents("../data/users.json");  
            $data = json_decode($data, true);
            foreach($data as $user){
                if($user['username']==$username && $user['password']==$password){
                    return $user;
                }
            }
        }
        else{
            return false;
        }
    }
    else{
        return false;
    }
}
?>