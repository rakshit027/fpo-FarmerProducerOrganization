<?php require_once("includes/functions.php");?>
<?php require_once("includes/db.php");?>

<?php require_once("includes/sessions.php"); ?>
<!-- ==================================================================================================== -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link rel="stylesheet" href="css/Styles.css">
  <title>Document</title>
</head>
<body>
  <!-- NAVBAR -->
  <div style="height:10px; background:#27aae1;"></div>
      <!--ABOVE DIV WILL GET """"BLUE STRIP"""" ABOVE header -->
      <!--to color navbar button add navbar-dark as below   -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container ml-5">
      <a href="#" class="navbar-brand">    FPO.com   </a>

      <!--this below button will get all the items into its div with the help of class and ""ID"" which must not be missed -->
      <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarcollapseCMS">
        <!--SPAM THE ICON class TO GET THE BUTTON   -->
        <span class="navbar-toggler-icon"></span>
      </button>

      <!---->
      <!---->
      <!---->
      <div class="collapse navbar-collapse" id="navbarcollapseCMS">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a href="MyProfile.php" class="nav-link"> <i class="fas fa-user text-success"></i> My Profile</a>
        </li>
        <li class="nav-item">
          <a href="formembers.php" class="nav-link">Home</a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">About Us</a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">Features</a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">Members</a>
        </li>
        <li class="nav-item">
          <a href="requests.php" class="nav-link">Requests</a>
        </li>

      <ul class="navbar-nav ml-5">
        <form class="form-inline d-none d-sm-block" action="formembers.php">
          <div class="form-group">
            <input class="form-control mr-1" type="text" name="search" value="" placeholder="search here">
            <button class="btn btn-primary" name="searchbutton">go</button>

          </div>
        </form>
      </ul>

      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a href="Logout.php" class="nav-link text-danger">
          <i class="fas fa-user-times"></i>
           Logout
         </a>
       </li>
      </ul>
      </div>
    </div>
  </nav>
    <div style="height:10px; background:#27aae1;"></div>
    <!-- NAVBAR END -->
    <!-- ========================================================================================================================================== -->
    <!-- HEADER -->
<div class="w3-container">
  <div class="row mt-4">
    <!-- main area -->
    <div class="offset-sm-1 col-sm-7" style="min-height:40px;background:white">
      <div class="col-sm-12">
        <h3>Welcome To FPO</h1>
        <h2 class="lead">Feeds Below</h1>
          <?php

          global $connectingdb;
          if(isset($_GET["searchbutton"])){
              $search=$_GET["search"];
              $sql="SELECT * FROM posts
                         WHERE
                         datetime LIKE :search
                         or title LIKE :search
                         or category LIKE :search
                         or post LIKE :search";
              $stmt=$connectingdb->prepare($sql);
              $stmt->bindValue(':search','%'.$search.'%');
              // PDO named parameter used :search
              // % is used as we use like operator
              //as """like""" is used it means that dint worry about othr values
              $stmt->execute();

          }else {
            $postidfromurl=$_GET["id"];
            $sql="SELECT * FROM posts WHERE id='$postidfromurl'";
            $stmt=$connectingdb->query($sql);

          }
          while ($DataRows=$stmt->fetch()) {
                $Id = $DataRows["id"];
                $DateTime  = $DataRows["datetime"];
                $PostTitle = $DataRows["title"];
                $Category  = $DataRows["category"];
                $Admin     = $DataRows["author"];
                $Image1     = $DataRows["image1"];
                $Image2     = $DataRows["image2"];
                $PostText  = $DataRows["post"];

           ?>
           <div class="card">
             <div class="row">
               <div class="col-lg-12">
                 <img src="upload/<?php echo $Image1 ?>" class="card-top" style="max-height:200px;"/>
                 &nbsp;
                 <img src="upload/<?php echo $Image2 ?>" class="card-top" style="max-height:200px;" />

               </div>
             </div>
           <div class="card-body ">
             <h4 class="card-title"><?php echo $PostTitle; ?></h4>
             <small class="card-muted">Category:<?php echo $Category; ?><br>Written by:<?php echo $Admin; ?> On <?php echo $DateTime; ?></small>
             <span style="float:right" class="badge badge-dark text-light">
               comments

             </span>
             <hr>
             <p class="card-text">
                  <?php echo $PostText; ?>
             </p>

           </div>
         </div>
         <br>

       <?php } ?>


      </div>
    </div>
    <!-- main area end -->


    <!-- side area -->
    <div class="col-sm-3" style="min-height:40px;background:green">

    </div>
    <!-- side area end -->
  </div>
</div>






































<!-- ======================================================================================================================= -->
<?php require_once("footer.php"); ?>
