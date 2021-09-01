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

    .container {
        min-height: 85vh;
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
    <!-- Search results -->
    <?php
        $search = $_GET['search'];
         $sql="SELECT * FROM `threads` where match (thread_title,thread_desc) against('$search')";
         $result = mysqli_query($conn,$sql);
         $noResult = true;
         $rowcount=mysqli_num_rows($result);
        
 
            
        ?>
    <div class="container">
        <h1 class="text-center my-2">Search results  for <em>"<?php  echo $_GET['search']; ?>"</em></h1>
        <h3  class="text-center my-0 "><?php  echo  $rowcount;?> results found</h3>
        <div class="search_results my-4 py-2  container p-5 bg-light border rounded-3">
            <div class="d-flex col my-3 ">

                <?php
        
                while ($row = mysqli_fetch_assoc($result)) {
                    $noResult = false;
                       $id =$row['thread_id'];
                        $thread_title = $row['thread_title'];
                        $thread_desc= $row['thread_desc'];
                        $url = "threads.php?threadid=".$id;

                        echo ' <div class="mx-4 col ">
                        <a class="text-dark" href="'.$url.'"> <h2><b>'. $thread_title .': </b></h2> </a>
                        <p class="display-6">'.$thread_desc.'</p>
                    </div>
                    
                </div>
                <div class="d-flex col">';
                        
                        }
                        if($noResult){
                            echo ' <div class="h-100  container-fluid p-5 bg-light border rounded-3">
                            <div class="display-6 ">No Results Found!</div>
                            <div ><p >Your search - <span><em> '.$search.'</em>
                            </span> - did not match any documents.</p>
                            <p>Suggestions:</p>
                            <ul>
                            <li>Make sure that all words are spelled correctly.</li>
                            <li>Try different keywords.</li>
                            <li>Try more general keywords.</li>
                            <li>Try fewer keywords.</li>
                            </ul>
                            </div>
                        </div>
            ';
                        }
 
            
        ?>



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