<?php
require '../models/loginModel.php';
function askLogin($username, $password){
    if(isset($_POST['submit'])){
        if(isset($_POST['username']) && isset($_POST['password'])){
            $username = $_POST['username'];
            $password = $_POST['password'];
            $user = login($username, $password);
            if($user!=false){
                if($user['access']=="admin"){
                    session_start();
                    $_SESSION['username'] = $username;
                    header('location:../views/adminContentRequestsView.php');
                }
                else if($user['access']=="solutionProvider"){
                    session_start();
                    $_SESSION['username'] = $username;
                    header('location:../views/solutionProviderDashboard.php');
                }
            }
            else{
                header('location:../views/loginView.php');
            }
        } else{
            header('location:../views/loginView.php');
        }
    } else{
        header('location:../views/loginView.php');
    }
}
?>