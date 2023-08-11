<?php
require '../controllers/registrationController.php';
$msg = '';
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if($_POST['submit'] == 'Register'){
        $data['firstName'] = $_POST['firstName'];
        $data['lastName'] = $_POST['lastName'];
        $data['username'] = $_POST['username'];
        $data['password'] = $_POST['password'];
        $data['confirmPassword'] = $_POST['confirmPassword'];
        $data['email'] = $_POST['email'];
        $data['type'] = $_POST['type'];
        if(empty($data['firstName']) || empty($data['lastName']) || empty($data['username']) || empty($data['password']) || empty($data['confirmPassword']) || empty($data['email']) || empty($data['type'])){
            $msg = "Please fill up all the fields";
        }
        else {
            $msg = register($data);
        }
        
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
</head>
<body>
    <?php require 'nav.php';?>
    <br>
    <h1>Registration</h1>
    <form action="registration.php" method="post">
        <label for="firstName">First Name:</label>
        <input type="text" name="firstName" id="firstName">
        <br>
        <label for="lastName">Last Name:</label>
        <input type="text" name="lastName" id="lastName">
        <br>
        <label for="username">Username: </label>
        <input type="text" name="username" id="username">
        <br>
        <label for="password">Password: </label>
        <input type="password" name="password" id="password">
        <br>
        <label for="confirmPassword">Confirm Password: </label>
        <input type="password" name="confirmPassword" id="confirmPassword">
        <br>
        <label for="email">Email: </label>
        <input type="email" name="email" id="email">
        <br>
        <label for="type">Type: </label>
        <?php
            $types = askAllTypes();
            //var_dump($types);
            echo "<select name='type' id='type'>";
            foreach($types as $type){
                echo "<option value='".$type['name']."'>".$type['name']."</option>";
            }
            echo "</select>";
        ?>
        <p>must choose solution provider for lab task 6</p>
        <br>
        <input type="submit" name ="submit" value="Register">
        <input type="reset" name="reset" value="Reset">
    </form>
    <br>
    <?php echo $msg;?>
</body>
</html>
