<?php
$showError="false";
if($_SERVER["REQUEST_METHOD"]== "POST"){
    include './_dbconnect.php';
    $email = $_POST["loginEmail"];
    $pass = $_POST["loginPass"];
    
    

    $sql = "SELECT * FROM `users` WHERE user_email='$email'";
    $result =mysqli_query($conn,$sql);
    $numRows = mysqli_num_rows($result);
    if($numRows ==1){
    $row = mysqli_fetch_assoc($result);
    if(password_verify($pass, $row['user_password'])){
        session_start();
        $_SESSION['loggedin']=true; 
        $_SESSION['useremail'] =$email;
        $_SESSION['username'] = $row['user_name'];
        $_SESSION['userTime'] = $row['user_time'];
        $_SESSION['sno'] = $row['sno'];

        header("Location:/forum/index.php");
    }  else{
        $error="Passwords do not match";
        header("Location:/forum/index.php?error=$error");

       }
    }else{
        $error="User doesn't exist";
        header("Location:/forum/index.php?error=$error");
    }

}
?>
