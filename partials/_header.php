<?php 
session_start();

echo'<nav class="navbar navbar-expand-lg navbar-dark bg-dark  justify-content-center">
  <div class="container-fluid ">
    <a class="navbar-brand" href="./index.php">MyCodeForum</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./About.php">About us </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbafDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Categories
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
        include '_categories.php';
       echo'
     </ul>
</li>
<li class="nav-item">
  <a class="nav-link " href="./Contact.php">Contact Us </a>
</li>
</ul>';?>
<?php

     if(isset($_SESSION['loggedin'])&& $_SESSION['loggedin']==true){
        echo '<form class="d-flex" action="/forum/search.php" method="GET">
        <div class="  d-flex">
        <input class="form-control me-2" type="search"  placeholder="Search" aria-label="Search" name="search">
        <button class="btn btn-primary" type="submit">Search</button>
        </div>
        <div class="flex-shrink-0 mx-2">
        <img src="./img/user.png" class="my-1" style="width:30px;" alt="...">
        <strong class="text-light "> Welcome '.$_SESSION['username'].'</strong>
        <a href="/forum/partials/_logout.php" class="btn btn btn-outline-primary"  >LogOut</a>


    </div>
      </form>';
    }else{
     echo  '<form class="d-flex  ">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-primary " type="submit">Search</button>
        
      </form>
      <div class="mx-1 m-auto ">
          <button class="btn btn btn-outline-primary"  data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
          <button class="btn btn btn-outline-primary"  data-bs-toggle="modal" data-bs-target="#SignupModal">SignUp</button>
      </div>';
    }
    
      echo '</div>
  </div>
</nav>';


include './partials/_login.php';

include './partials/_signup.php';
if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="true"){
  echo '<div class="alert alert-success alert-dismissible fade my-0  show" role="alert">
  <strong>Yeaah!</strong> signed up 
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
else{
  if(isset($_GET['error'])){
    echo '<div class="alert alert-warning alert-dismissible fade my-0  show" role="alert">
    <strong>Error!</strong> '.$_GET['error'].'
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';    
  }
}
?>