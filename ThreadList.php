<!doctype html>
<html lang="en">

<head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>iDiscuss - Coding Forums</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
     <?php include 'partials/_dbconnect.php'?>
     <?php include 'partials/_header.php'?>
     
     <?php
     $id = $_GET['catid']; 
     $sql = "SELECT * FROM `categories` WHERE Category_ID = '$id'";
     $result = mysqli_query($conn,$sql);
     while($row = mysqli_fetch_assoc($result)){
          $catname = $row['Category_Name'];
          $catdesc = $row['Category_Discription'];
     }
      
     ?>

     <?php 
     $showalert = false; 
     $method = $_SERVER['REQUEST_METHOD'];
     if($method=='POST'){
          // insert thread into db
          $th_title = $_POST['title'];
          $th_desc = $_POST['desc'];

          $th_title = str_replace("<","&lt",$th_title);
          $th_title = str_replace(".", "&gt", $th_title);

          $th_desc = str_replace("<","&lt",$th_desc);
          $th_desc = str_replace(".", "&gt", $th_desc);

          $sno = $_POST["sno"];
          $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$th_title', '$th_desc', '$id', '$sno', current_timestamp())";
          $result = mysqli_query($conn,$sql);
          $showalert = true;
          if($showalert){
               echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
               <strong>Success!</strong> Your threads has been added.
               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
             </div>';
          }        
     }
     ?>

     <!-- Categorie container starts here -->
     <div class="container my-3">
          <div class="bg-light p-5">
               <h1 class="display-4 lead ">Welcome to <?php echo $catname ?> Forum</h1>
               <p class="lead"><?php echo $catdesc ?></p>
               <hr class="my-4">
               <p class="lead">This forum a perr to perr forum for sharing knowladge with each others. Keep it
                    friendly.Be courteous and respectful. Appreciate that others may have an opinion different from
                    yours.Stay on topic. Share your knowledge. Refrain from demeaning,or harassing behaviour and speech.
               </p>
               <p class="lead">
                    <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
               </p>
          </div>
     </div>
     <?php
     if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
         echo '<div class="container">
               <h1 class="py-2">Start a Discussion</h1>
               <form method="post" actiion='.$_SERVER["REQUEST_URI"].'>
     <div class="mb-3">
     <input type="hidden" name="sno" value="'.$_SESSION["sno"].'">
          <label for="exampleInputEmail1" class="form-label">Problem Title</label>
          <input required type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
          <div id="emailHelp" class="form-text">Keep your title as crisp and short as possible</div>
     </div>
     <div class="mb-3">
          <label for="exampleFormControlTextarea1" class="form-label">Ellaborate your concern</label>
          <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
          <button type="submit" class="btn btn-success my-3">Submit</button>
          </form>
     </div>';
     }else{
     echo '<div class="container">
               <h1 class="py-2">Start a Discussion</h1>
               <p class="lead">You are not logged in. Please Login and come back.</p>
          </div>';
     }
     ?>

     <div class="container">
          <h1 class="py-2">Browse Questions</h1>

          <?php
               $id = $_GET['catid']; 
               $sql = "SELECT * FROM `threads` WHERE thread_cat_id = '$id'";
               $result = mysqli_query($conn,$sql);
               $noResult = true;
               while($row = mysqli_fetch_assoc($result)){
                    $noResult = false;
                    $id = $row['thread_id'];
                    $title = $row['thread_title'];
                    $desc = $row['thread_desc'];
                    $thread_time = $row['timestamp']; 
                    $thread_uer_id = $row['thread_user_id']; 
                    $sql2 = "SELECT user_email FROM `users` WHERE sno = '$thread_uer_id'";
                    $result2 = mysqli_query($conn,$sql2);
                    $row2 = mysqli_fetch_assoc($result2);
                    
               

          echo '<div class="d-flex my-3">
               <div class="flex-shrink-0">
                    <img src="img/user.png" width="44px" alt="...">
               </div>
               <div class="flex-grow-1 ms-3">
                    <h5 class="mt-0"><a class="text-dark text-decoration-none" href="thread.php?threadid='.$id.'">'.$title.'</a></h5>
                    '.$desc.'
                    <p class="fw-bold my-0">Asked By '. $row2['user_email'].'  at  '.$thread_time.'</p>
               </div>
          </div>';
     }
     
     

     if($noResult){
          echo'<div class="bg-light">
          <div class="container">
            <h1 class="display-4 p-4">No Threads found</h1>
            <p class="lead p-4">Be the first person to ask a question</p>
          </div>
        </div><b></b>';
     }
      
     ?>




          <?php include 'partials/_footer.php'?>
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
               integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
               crossorigin="anonymous">
          </script>
</body>

</html>