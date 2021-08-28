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
    #ques {
        min-height: 180px;
    }

    body {
        background-color: #e2e0e0;
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
            $id = $_GET['threadid'];
            $sql="SELECT * FROM `threads` WHERE  thread_id= $id";
        $result = mysqli_query($conn,$sql);
        
        while ($row = mysqli_fetch_assoc($result)) {
               
                $thread_title = $row['thread_title'];
                $thread_desc= $row['thread_desc'];
                $thread_user_id = $row['thread_user_id'];
                //to display user who posted 

                $sql2 = "SELECT user_name FROM `users` where sno = $thread_user_id ";
                $result2 = mysqli_query($conn,$sql2);
                 $row2= mysqli_fetch_assoc($result2);
                 

        }   
            ?>

    <?php
        
        $showAlert = false;
        $method = $_SERVER["REQUEST_METHOD"];

          if($method== 'POST'){
              //fetch sno from users
            

              //insert into db
              $comment= $_POST["comment"];
            $userid = $_POST['sno'];
            $comment=str_replace("<","&lt;",$comment);
            $comment=str_replace(">","&gt;",$comment);

              $sql="INSERT INTO `comments` (`comment_id`, `comment_content`, `thread_id`, `commented_by`, `commentTime`) VALUES (NULL, '$comment', '$id', '$userid', current_timestamp())";
              $result = mysqli_query($conn,$sql);
              $showAlert = true;
            //   if(!$result){
            //       echo mysqli_error($conn);
            //   }
           

          }
      ?>
   

        <?php 
   if($showAlert){
       echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
       <strong>Yeaah!</strong> Your Comment has been added!
       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
     </div>';
   }
   ?>

            <!-- Category container starts here! -->
            <div class="container my-4">


                <div class="h-100 p-5 bg-light border rounded-3">
                    <h2> <?php echo $thread_title?> </h2>
                    <p><?php echo $thread_desc?></p>
                    <div class="forum">
                        <hr>
                        posted by <strong><?php echo $row2["user_name"];?> </strong>
                    </div>

                </div>

                <div class="container row my-2" id="ques">
                    <h1>Comments</h1>
                    <?php
            if(isset($_SESSION['loggedin'])&& $_SESSION['loggedin']==true){
           echo'  <div class="container">
           <form class="my-3" action="'. $_SERVER['REQUEST_URI'].'" method="post">
               <div class="mb-3">
               <input type="hidden" name="sno" value="'.$_SESSION['sno'].'">
                   <label for="exampleInputEmail1" class="form-label">Comment</label>
                   <input type="text" placeholder="Write comment" class="form-control"
                       id="exampleInputEmail1" aria-describedby="emailHelp" name="comment">
                   <div id="emailHelp" class="form-text">Post your comment</div>
               </div>

               <button type="submit" class="btn btn-primary">Post comment</button>
           </form>
       </div>
';}
       else{
           echo ' <div class="container">
           <p class="display-5">You are not logged in. Please login to comment.</p>
       </div>';
       }
           ?>




                    <?php
        
        $id = $_GET['threadid'];
        $sql="SELECT * FROM `comments` WHERE  thread_id= $id";
    $result = mysqli_query($conn,$sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $id =$row['comment_id'];
        $content = $row['comment_content'];
        $comment_time= $row['commentTime'];
        $commented_by= $row['commented_by'];

        $sql2 = "SELECT user_name FROM `users` where sno =$commented_by";
        $result2 = mysqli_query($conn,$sql2);
         $row2= mysqli_fetch_assoc($result2);
          
        echo  '
    <div class="w-100 my-3">
        <div class="d-flex col">
            <div class="flex-shrink-0">
                <img src="./img/user.png" style="width:50px;" alt="...">
            </div>
            <div class="flex-grow-1 ms-3 col">
                <strong> Commented by '.$row2['user_name'].' at '.$comment_time.'</strong>
                <p>'.$content.'</p>
         </div>
     </div>
     </div>';
    }   
      ?>



                </div>

            </div>
        </div>
   
    </div>

    <div class="div">
        <?php   
      
        include './partials/_footer.php';?>
    </div>


    <!-- Optional JavaScript; choose one of the two! -->

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