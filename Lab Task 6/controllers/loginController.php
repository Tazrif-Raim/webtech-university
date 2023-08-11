<?php
require '../models/model.php';
function validateLogin($username, $password, $remember){
    if($username == "" || $password == ""){
        return "Username or Password cannot be Empty";
    }
    else{
        if($remember === "Remember"){
            setcookie("username", $username, time()+(86400*30), "/");
            setcookie("password", $password, time()+(86400*30), "/");
        }
        else{
            setcookie("username", $username, time()-3600, "/");
            setcookie("password", $password, time()-3600, "/");
        }
        $row = checkLogin($username);
        if($row == null){
            return "Username or Password is Invalid";
        }
        $hash = $row["password"];
        if(password_verify($password, $hash)){
            
            session_start();
            $_SESSION["username"] = $username;
            $_SESSION["access"] = $row["access"];
            if($row["access"] == "Admin"){
                header("Location: adminDashboard.php");
            }
            else if($row["access"] == "Solution Provider"){
                header("Location: solutionProviderDashboard.php");
            }
            else if($row["access"] == "Reporter"){
                header("Location: reporterDashboard.php");
            }
            else if($row["access"] == "Researcher"){
                header("Location: researcherDashboard.php");
            }
        }
        else{
            return "Username or Password is Invalid";
        }
        
    }
}
?>