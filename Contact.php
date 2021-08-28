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
    .container {
        min-height: 85vh;
    }
    </style>
</head>

<body>
    <?php
        include './partials/_header.php';
        include './partials/_dbconnect.php';
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $user_email = $_POST['user_email'];
            $concern = $_POST['concern'];

        $sql="INSERT INTO `contacts` (`user_email`, `concern`, `contacted_at`) VALUES ( '$user_email', '$concern', current_timestamp())";
        $result = mysqli_query($conn,$sql);
        if($result){
            $showAlert= true;
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Thankyou!</strong> Your concern has been recorded , We will try to fix them ASAP.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
        }
        ?>

    <div class="container ">
        <h1 class="text-center my-2">Contact us</h1>
        <form action="" method="post">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" name="user_email">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Enter your concern</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="concern"></textarea>
                <button class="btn btn-primary my-2" type="submit">Submit</button>
            </div>

        </form>
    </div>

    <?php    include './partials/_footer.php';?>
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