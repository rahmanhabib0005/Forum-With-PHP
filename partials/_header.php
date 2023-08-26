<?php
session_start();


echo '<nav class="navbar navbar-dark  navbar-expand-lg bg-dark">
<div class="container-fluid">
      <a class="navbar-brand" href="/forum">iDiscuss</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/forum">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contract.php">Contract</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
             Top Categories
            </a>
            <ul class="dropdown-menu">';


            $sql = "SELECT Category_Name, Category_ID FROM `categories` LIMIT 4 ";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)){
              echo'<li><a class="dropdown-item" href="ThreadList.php?catid='.$row['Category_ID'].'">'.$row['Category_Name'].'</a></li>';
            }
            echo'</ul>
          </li>
          
        </ul>';
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
         echo '<form class="d-flex" role="search" action="search.php" method="get">
         <p class="text-light  my-2 mx-1 fw-bold"> '.$_SESSION['useremail'].'</p>
          <input class="form-control" type="search" name="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-success mx-2" type="submit">Search</button>
          <a href="partials/_handle_logout.php" class="btn btn-success" type="submit">Logout</a>
        </form>';
        }
        else{
         echo '<button class="btn btn-outline-primary ms-2" data-bs-toggle="modal" data-bs-target="#loginmodal">Login</button>
          <button class="btn btn-outline-primary mx-2" data-bs-toggle="modal" data-bs-target="#signupmodal">Signup</button>';}
   echo   
   '</div>
  </div>
</nav>';
        
        

include "partials/loginmodal.php";
include "partials/signupmodal.php";

if(isset($_GET['signupsucces']) && $_GET['signupsucces'] == "true"){
  echo '<div class="alert alert-warning alert-dismissible fade show my-0" role="alert">
  <strong>Success!</strong> You can log in.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
if(isset($_GET['signupsucces']) && $_GET['signupsucces'] != "true"){
  echo '<div class="alert alert-warning alert-dismissible fade show my-0" role="alert">
  <strong>Sorry!</strong> You are doing some mistake here.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
?>