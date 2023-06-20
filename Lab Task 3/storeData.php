<?php  
 $message = '';  
 $error = '';  
 if(isset($_POST["submit"]))  
 {  
      if(empty($_POST["name"]))  
      {  
           $error = "<label>Enter Name</label>";  
      }
      else if(empty($_POST["email"]))  
      {  
           $error = "<label>Enter an e-mail</label>";  
      }  
      else if(empty($_POST["un"]))  
      {  
           $error = "<label>Enter a username</label>";  
      }  
      else if(empty($_POST["pass"]))  
      {  
           $error = "<label >Enter a password</label>";  
      }
      else if(empty($_POST["Cpass"]))  
      {  
           $error = "<label>Confirm password field cannot be empty</label>";  
      } 
      else if(empty($_POST["gender"]))  
      {  
           $error = "<label>Gender cannot be empty</label>";  
      } 
      else if(empty($_POST["dob"]))
      {
        $error = "<label>Date of Birth cannot be empty</label>";
      }
       
      else  
      {  
           if(file_exists('data.json'))  
           {  
                $current_data = file_get_contents('data.json');  
                $array_data = json_decode($current_data, true);  
                $new_data = array(  
                     'name'               =>     $_POST['name'],  
                     'e-mail'          =>     $_POST["email"],  
                     'username'     =>     $_POST["un"],  
                     'gender'     =>     $_POST["gender"],  
                     'dob'     =>     $_POST["dob"]  
                );  
                $array_data[] = $new_data;  
                $final_data = json_encode($array_data);  
                if(file_put_contents('data.json', $final_data))  
                {  
                     $message = "<label>File Appended Successfully</p>";  
                }  
           }  
           else  
           {  
                $error = 'JSON File does not exists';  
           }  
      }  
 }  
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           
      </head>  
      <body>  
            
           <div>  
                <h3>Lab Task 3: 4. Registration</h3>                 
                <form method="post">  
                     <?php   
                     if(isset($error))  
                     {  
                          echo $error;  
                     }  
                     ?>  
                      
                     <label>Name:</label>
                     <input type="text" name="name" /><hr>  
                     <label>E-mail:</label>
                     <input type="text" name = "email"/><hr />
                     <label>User Name:</label>
                     <input type="text" name = "un"/><hr />
                     <label>Password:</label>
                     <input type="password" name = "pass"/><hr />
                     <label>Confirm Password:</label>
                     <input type="password" name = "Cpass"/><hr />

                    <fieldset>
                    <legend>Gender</legend>
                    <input type="radio" id="male" name="gender" value="male">
                     <label for="male">Male</label>                     
                     <input type="radio" id="female" name="gender" value="female">
                     <label for="female">Female</label>
                     <input type="radio" id="other" name="gender" value="other">
                     <label for="other">Other</label><hr>
                    </fieldset>
                    <fieldset>
                     <legend>Date of Birth:</legend>
                     <input type="date" name="dob"> <hr>
                    </fieldset> 
                     
                     <input type="submit" name="submit" value="Add"/><br /> 
                     <input type="reset" name="reset" value="Reset"/><br />                     
                     <?php  
                     if(isset($message))  
                     {  
                          echo $message;  
                     }  
                     ?>  
                </form>
           </div>  
           <br />  
      </body>  
 </html>  