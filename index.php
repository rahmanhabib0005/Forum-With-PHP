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
     

     <!-- Slider start here -->
     <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
          <div class="carousel-indicators">
               <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
               <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
               <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
          </div>
          <div class="carousel-inner">
               <div class="carousel-item active" style="height: 500px">
                    <img src="img/slider1.jpg" style="min-height: 500px" class="d-block w-100"
                         alt="...">
               </div>
               <div class="carousel-item" style="height: 500px">
                    <img src="img/slider2.jpg"
                         style="min-height: 500px" class="d-block w-100" alt="...">
               </div>
               <div class="carousel-item" style="height: 500px">
                    <img src="img/slider.jpg" class="d-block w-100"
                         style="min-height: 500px" alt="...">
               </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
               data-bs-slide="prev">
               <span class="carousel-control-prev-icon" aria-hidden="true"></span>
               <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
               data-bs-slide="next">
               <span class="carousel-control-next-icon" aria-hidden="true"></span>
               <span class="visually-hidden">Next</span>
          </button>
     </div>

     <!-- Categorie container starts here -->
     <div class="container my-3">
          <h2 class="text-center my-3">iDiscuss - Browse Categories</h2>
          <div class="row my-3">
               <!-- Fetch all the Categories -->
               <!-- Use a for loop to iterate through Categories -->
               <?php
            $sql = "SELECT * FROM `categories`";
            $result = mysqli_query($conn,$sql);
            while($row = mysqli_fetch_assoc($result)){
              // echo $row['Category_ID'];
              // echo $row['Category_Name'];
              $id = $row['Category_ID'];
              $cat = $row['Category_Name'];
              $desc = $row['Category_Discription'];
              echo '<div class="col-md-4 my-4">
              <div class="card" style="width: 18rem;">
                   <img src="img/'.$id.'.jpg" class="card-img-top" alt="...">
                   <div class="card-body">
                        <h5 class="card-title"><a href="ThreadList.php?catid='.$id.'">'.$cat.'</a></h5>
                        <p class="card-text">'.substr($desc,0,90).'...</p>
                        <a href=ThreadList.php?catid='.$id.'" class="btn btn-primary">View Threads</a>
                   </div>
                </div>
              </div>';
            }


           ?>

          </div>
     </div>


     <?php include 'partials/_footer.php'?>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
     </script>
</body>

</html>