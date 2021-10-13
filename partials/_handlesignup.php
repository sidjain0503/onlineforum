<?php
$showError="false";
if($_SERVER["REQUEST_METHOD"]== "POST"){
    include './_dbconnect.php';
    $user_email= $_POST["signupemail"];
    $pass = $_POST["signupPassword"];
    $cpass = $_POST["signupcPassword"];
    $username= $_POST["username"];
    //check weather this mail exists 
    $existsql = "SELECT * FROM `users` WHERE user_email = '$user_email'";
    $result = mysqli_query($conn,$existsql);
    $numRows = mysqli_num_rows($result);
    if($numRows >0){
        $showError ="Email already in use! Try again.";
    }else{
        if($pass ===$cpass){
           $hash = password_hash($pass , PASSWORD_DEFAULT);
           $sql = "INSERT INTO `users` (`user_email`,`user_name`, `user_password`, `user_time`) VALUES ('$user_email','$username', '$hash', current_timestamp())";
           $result = mysqli_query($conn,$sql);
           if($result){
               $showAlert = true;
               header("Location:/forum/index.php?signupsuccess=true");
               exit();
           }
           
        }else{
            $showError= "passwords do not match";
            

        }
    }
    header("Location:/forum/index.php?signupsuccess=false&error=$showError");

}

?>
<!--  -->