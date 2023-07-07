<?php
    if(isset($_POST['submit'])){
        if(isset($_POST['email'])){
            $email = $_POST['email'];
            $data = file_get_contents("data.json");  
            $data = json_decode($data, true);
            if(isset($data)){
                $flag = false;
                foreach($data as $user){
                    if($user["e-mail"]==$email){
                        $msg = "Email exists";
                        $flag = true;
                        break;
                    }
                }
                if(!$flag) $msg = "Email Not Found";
            } else {
                $msg = "Cannot access data file";
            }
        }
        else {
            $msg = "Email not found";
        }
        
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
</head>
<body>
    <?php require 'navbar.php'?>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <fieldset>
            <legend><h2>Forgot Password</h2></legend>
            <span>
            <?php
                if (isset($msg)) {
                    echo $msg;
                    echo "<br>";
                }
            ?>	 	
            </span>
            Enter Email:
            <input type="email" name="email">
            <hr>
            <input type="submit" name="submit" value="Submit">
        </fieldset>
    </form>
    <?php include 'footer.php'?>
</body>
</html>