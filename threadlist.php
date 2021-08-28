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
            $id = $_GET['catid'];
            $sql="SELECT * FROM `categories` WHERE  category_id= $id";
        $result = mysqli_query($conn,$sql);
        while ($row = mysqli_fetch_assoc($result)) {
                $catname = $row['category_name'];
                $catdesc= $row['category-desc'];
        }   
            ?>

    <?php
        
          $showAlert = false;
          $method = $_SERVER["REQUEST_METHOD"];

            if($method== 'POST'){
                //insert into db
                $userid= $_POST["sno"];
                $th_title= $_POST["title"];
                $th_desc = $_POST["desc"];
                //securing from xxl attack
                $th_desc=str_replace("<","&lt;", $th_desc);
                $th_desc=str_replace(">","&gt;", $th_desc);
                $sql="INSERT INTO `threads` (`thread_id`, `thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `datetime`) VALUES (NULL, '$th_title', '$th_desc', '$id', '$userid', current_timestamp());";
                $result = mysqli_query($conn,$sql);
                $showAlert = true;

            }
        ?>
    <div>

    <?php 
     if($showAlert){
         echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
         <strong>Yeaah!</strong> Your question has been recorded , please wait until someone from community responds.
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
       </div>';
     }
     ?>
        <!-- Category container starts here! -->
        <div class="container my-4">


            <div class="h-100 p-5 bg-light border rounded-3">
                <h2>Welcome to <?php echo $catname?> forums</h2>
                <p><?php echo $catdesc?></p>
                <div class="forum">
                    <strong>Forum Rules</strong>
                    <ul>
                        <li>No Spam / Advertising / Self-promote in the forums.
                            .</li>
                        <li>
                            Do not post “offensive” posts, links or images
                        </li>
                        <li>
                            Do not post copyright-infringing material.</li>
                    </ul>
                </div>
                <button class="btn btn-outline-primary" type="button">Browse more</button>
            </div>

            <div class="container-fluid row my-2" id="ques">
            <h1>Start a discussion</h1>
           <?php
            if(isset($_SESSION['loggedin'])&& $_SESSION['loggedin']==true){
           echo' <div class="container">
           
           <!-- FORM  -->
           <form class="my-3" action="'.$_SERVER['REQUEST_URI'].'" method="post">
                <input type="hidden" name="sno" value="'. $_SESSION["sno"] .'">
               <div class="mb-3">
                   <label for="exampleInputEmail1" class="form-label">Problem Title</label>
                   <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                       name="title">
                   <div id="emailHelp" class="form-text">Keep your title as crisp as possible.</div>
               </div>
               <div class="mb-3">
                   <label for="text-area" class="form-label">Elaborate your problem</label>
                   <textarea class="form-control" name="desc" id="" id="text-area" cols="30"
                       rows="5"></textarea>
               </div>

               <button type="submit" class="btn btn-primary">Submit</button>
           </form>

       </div>';}
       else{
           echo ' <div class="container">
           <p class="display-5">You are not logged in. Please login to start a discussion</p>
       </div>';
       }
           ?>
        <h1>Browse Questions</h1>
                <?php   
            $id = $_GET['catid'];
            $sql="SELECT * FROM `threads` WHERE  thread_cat_id= $id";
        $result = mysqli_query($conn,$sql);
        $noResult = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
            $id =$row['thread_id'];
                $thread_title = $row['thread_title'];
                $thread_desc= $row['thread_desc'];
                $thread_time= $row['datetime'];
                $thread_user_id= $row['thread_user_id'];

            $sql2 = "SELECT user_name FROM `users` where sno =$thread_user_id";
            $result2 = mysqli_query($conn,$sql2);
             $row2= mysqli_fetch_assoc($result2);
              

              echo  '<div class="w-100 my-3">
                <div class="d-flex col">
                    <div class="flex-shrink-0">
                        <img src="./img/user.png" style="width:50px;" alt="...">
                    </div>
                    <div class="mx-4 col ">
                        <a class="text-dark" href="./threads.php?threadid='.$id.'" > <p><b>'.$thread_title.' : </b></p> </a>
                        <span>'.$thread_desc.'</span>
                    </div>
                    <strong> Asked by '. $row2['user_name'].' at '.$thread_time.'</strong>
                </div>
                </div>';
        }   
    
        if($noResult){
            echo '<div class="h-100 container-fluid p-5 bg-light border rounded-3">
            <p class="display-4">No Questions here!</p>
            <p>Be the first to ask the question</p>
          </div>';
        }
            ?>


            </div>

        </div>
    </div>
    </div>
    </div>

    </div>
  
        <?php    include './partials/_footer.php';?>


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