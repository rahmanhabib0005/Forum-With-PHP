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
     $showalert = false;
     $id = $_GET['threadid']; 
     $sql = "SELECT * FROM `threads` WHERE thread_id = '$id'";
     $result = mysqli_query($conn,$sql);
     $noResult = false;
     while($row = mysqli_fetch_assoc($result)){
          $noResult = true;
          $title = $row['thread_title'];
          $desc = $row['thread_desc'];
          $thread_user_id = $row['thread_user_id'];
          $sql2 = "SELECT user_email FROM `users` WHERE sno = '$thread_user_id'";
          $result2 = mysqli_query($conn,$sql2);
          $row2 = mysqli_fetch_assoc($result2);
          $posted_by = $row2['user_email'];
     }
      
     ?>
     <?php 
     $id = $_GET['threadid']; 
     $method = $_SERVER['REQUEST_METHOD'];
     if($method=='POST'){
          // insert thread into db
          $content =$_POST['comment'];
          $content = str_replace("<","&lt",$content);
          $content = str_replace(".", "&gt", $content);
          $sno = $_POST["sno"];
          $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$content', '$id','$sno', current_timestamp())";
          $result = mysqli_query($conn,$sql);
          $showalert = true;
          if($showalert){
               echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
               <strong>Success!</strong> Your comments has been added.
               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
             </div>';
          }        
     }
     ?>

     <!-- Categorie container starts here -->
     <div class="container my-3">
          <div class="bg-light p-5">
               <h1 class="display-4 lead "> <?php echo $title ?></h1>
               <p class="lead"><?php echo $desc ?></p>
               <hr class="my-4">
               <p class="lead">This forum a perr to perr forum for sharing knowladge with each others. Keep it friendly.Be courteous and respectful. Appreciate that others may have an opinion different from yours.Stay on topic.
               </p>
               <p>Posted by:<em> <?php echo $posted_by; ?></em></p>
          </div>
     </div>
     
     <?php
     if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
          echo'<div class="container">
               <h1 class="py-2">Post a comment</h1>
               <form method="post" actiion='.$_SERVER['REQUEST_URI']
                    .'<div class="mb-3">
                         <label for="exampleFormControlTextarea1" class="form-label">Type Your Comment</label>
                         <textarea required class="form-control" id="comment" name="comment" rows="3"></textarea>
                         <input type="hidden" name="sno" value="'.$_SESSION["sno"].'">
                         <button type="submit" class="btn btn-success my-3">Post Comment</button>
               </form>
          </div>';
          }else{
               echo '<div class="container">
                         <h1 class="py-2">Post a comment</h1>
                         <p class="lead">You are not logged in. Please Login and come back.</p>
                    </div>';
               }
     ?>
     <div class="container">
          <h1 class="py-2">Discussion</h1>

          <?php
               $id = $_GET['threadid']; 
               $sql = "SELECT * FROM `comments` WHERE thread_id = '$id'";
               $result = mysqli_query($conn,$sql);
               $noResult = true;
               while($row = mysqli_fetch_assoc($result)){
                    $noResult = false;
                    $id = $row['comment_id'];
                    $content = $row['comment_content'];
                    $comment_time = $row['comment_time'];
                    $thread_uer_id = $row['comment_by']; 

                    $sql2 = "SELECT user_email FROM `users` WHERE sno = '$thread_uer_id'";
                    $result2 = mysqli_query($conn,$sql2);
                    $row2 = mysqli_fetch_assoc($result2);
               

          echo '<div class="d-flex my-3">
               <div class="flex-shrink-0">
                    <img src="img/user.png" width="44px" alt="...">
               </div>
               <div class="flex-grow-1 ms-3">
                    <p class="fw-bold my-0">'. $row2['user_email'].' User at '.$comment_time.'</p>
                    '.$content.'
               </div>
          </div>';
     }


          if($noResult){
               echo'<div class="bg-light">
               <div class="container">
                 <h1 class="display-4 p-4">No Commnet found</h1>
                 <p class="lead p-4">Be the first person to ask a question</p>
               </div>
             </div>';
          }     
          ?>

          
         


     <?php include 'partials/_footer.php'?>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
     </script>
</body>

</html>