<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <title>Lets-Discuss</title>
    <style>
    body {
        background-color: #e2e0e0;
    }

    #maincont {
        margin-top:75px;
        min-height: 90vh;
        display: flex;
        justify-content: space-between;


    }

    .profile {
            width: 30%;
    }
    .activity{
        width: 70%;
    }

    .discussions{
        display: flex;
    }
    .thread_text{
        min-width:70%;

    }
    </style>
</head>

<body>
    <?php
        include './partials/_header.php';
        ?>
        <?php
        include './partials/_dbconnect.php';
        ?>

        
    <?php
         $deleted = false;

 $userid = $_GET['userid'];
 if(isset($_GET['delete'])){
    $delete = $_GET['delete'];
    $deleted=true;
    $sql="DELETE FROM `threads` WHERE `thread_id` = $delete";
    $result = mysqli_query($conn,$sql);
            }
            
            if($deleted){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong>Your discussion has been deleted!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
              }

?>

    <div class="container" id="maincont">
        <div class="profile"> 
     
            <div class="  my-4 p-10 text-center">

                <div class=" my-4 ">
                    <img src="./img/user.png" class="my-1" style="width:150px;" alt="...">
                    <div>
                    <?php
             $name=$_SESSION["username"]; 
             $email = $_SESSION['useremail'];
             $date =$_SESSION['userTime'];

             echo "<strong style='font-size:20px;'> $name</strong><br>";
             echo "<strong>Email:</strong> <span class='text-muted'> $email</span><br>";
             echo "<strong> Member since:</strong><span class='text-muted'> $date</span>";

             ?>

                    </div>
                 </div>
                 </div>
        </div>
        <div class="activity mx-4 my-4">
            <h2 class="featurette-heading  ">Your Discussions </h2>
            <?php
                               
                                    $sql = "SELECT * FROM `threads` where thread_user_id =$userid";
                                    $result= mysqli_query($conn,$sql);
                                    $num = mysqli_num_rows($result);
                                    // echo "total discussions ".$num;
                                    
                                    while($row = mysqli_fetch_assoc($result)){
                                            $title= $row['thread_title'];
                                            $desc = $row['thread_desc'];
                                            $threadid = $row['thread_id'];
            
                               if($result){
                                   
                                echo '
                                <div class="discussions my-4">
                                <div class="mx-4 thread_text  ">
                                    <a class="text-dark" href="./threads.php?threadid='.$threadid.'">
                                        <p><b>'. $title .' : </b></p>
                                    </a>
                                    <span>'.$desc.'</span>
                                </div>
                              
                                <div class="my-3">
                              
                                    <button class=" delete btn btn-primary btn-sm" name="'.$row['thread_id'].'">Delete</button>
              
                                </div>
                            </div> ';
                               }else{
                                //    echo var_dump($num);

                                echo '<div class="jumbotron">
                                <h1 class="display-4">Hello, world!</h1>
                                <hr class="my-4">
                              </div>';
                               }
                                    }
                                      
                                   
                                ?>


        </div>
        
    </div>

    


    <?php    include './partials/_footer.php';?>


    <!-- Optional JavaScript; choose one of the two! -->
    <script>
        deletes =document.getElementsByClassName('delete');
  Array.from(deletes).forEach((element)=>{
    element.addEventListener('click',(e)=>{
     sno= e.target.name;

      if(confirm("press ok ! if you want to delete this thread!")){
        console.log(sno);
     window.location= `/forum/profile.php?delete=${sno}&userid=<?php echo $_SESSION['sno'];?>`;
       
        //make a form and submit post it .
      }      
      else{
        console.log("no");
      }
    
    })
  })
    </script>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
    -->
</body>

</html>


 <!--


 <!--  -->