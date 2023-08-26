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
     

     <!-- Search result start here -->
     <div class="container my-3">
          <h1>Search result for <em>"<?php  echo $_GET['search']; ?>"</em></h1>
          <?php 
               //SELECT * FROM threads WHERE MATCH (thread_title, thread_desc) against ('not able'); 
               $noResult = true;
               $query = $_GET['search'];
               $sql = "SELECT * FROM threads WHERE MATCH (thread_title, thread_desc) against ('$query')";
               $result = mysqli_query($conn,$sql);
               
               while($row = mysqli_fetch_assoc($result)){
                    $title = $row['thread_title'];
                    $desc = $row['thread_desc'];
                    $thread_id = $row['thread_id'];
                    $url = "thread.php?threadid=".$thread_id;

                    $noResult = false;
                    echo'<div class="result">
                    <h3 class="py-2"><a href="'.$url.'" class="text-dark text-decoration-none">'.$title.'</a></h3>
                    <p>'.$desc.'</p>
                    </div>';

               }
          if($noResult){
               echo '<div class="bg-light">
               <div class="container">
                 <h1 class="display-4 p-4">No result found</h1>
                 <p class="lead p-4">Didnt match anything.</p>
               </div>
             </div>';
          }
     ?>
         
     </div>



     <?php include 'partials/_footer.php'?>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
     </script>
</body>

</html>