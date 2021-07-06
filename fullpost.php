<?php require_once("includes/functions.php");?>
<?php require_once("includes/db.php");?>

<?php require_once("includes/sessions.php"); ?>
<!-- ==================================================================================================== -->
<?php $searchquaryparameter = $_GET["id"]; ?>
<?php
  if (isset($_POST["Submit"])) {
  $name=$_POST["commnetername"];
  $email=$_POST["commenteremail"];
  $comment=$_POST["commenterthoughts"];
  date_default_timezone_set("Asia/Kolkata");
  $currenttime=time();//to get date we must get the time
  $currentdate=strftime("%B-%d-%Y %H-%M-%S",$currenttime);//this will take 2 Arguments 1-DATE FORMATE and 2-Current time variable

  if (empty($name)||empty($email)||empty($comment)) {
    //code For all the validation of categoryTitle
    $_SESSION["Errormsg"]="to comment all fields must be filled out";
    redirect_to("fullpost.php?id={$searchquaryparameter}");
  }elseif (strlen($comment)>500) {
    $_SESSION["Errormsg"]="comment cahracters should be less than 500 caharacters";
    redirect_to("fullpost.php?id={$searchquaryparameter}");
  }else {
    //query to add COMMENT into the database TABLE::::::::::::::::::::::::
    global $connectingdb;
    $sql = "INSERT INTO comments(datetime,name,email,comment,approvedby,status,post_id)";
    //PDO method used
    $sql.="VALUES(:datetime,:Name,:Email,:Comment,'pending','OFF',:postidfromurl)";
    //Dummy values used to make it SQL injection free
    $stmt =$connectingdb->prepare($sql);
    $stmt->bindValue(':Name',$name);//$stmt var will be considered as an OBJECT bcause of the arrow
    $stmt->bindValue(':Email',$email);
    $stmt->bindValue(':datetime',$currentdate);
    $stmt->bindValue(':Comment',$comment);
    $stmt->bindValue(':postidfromurl',$searchquaryparameter);
    //now take var and aboject and call the PDO method of Object
    $Execute=$stmt->execute();
    if ($Execute) {
      $_SESSION["Successmsg"]="comment submitted successfully";
      redirect_to("fullpost.php?id={$searchquaryparameter}");
    }else {
      $_SESSION["Errormsg"]="comments not added !! something went wrong WRONG ";
      redirect_to("fullpost.php?id={$searchquaryparameter}");
    }
  }
}



 ?>

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
          echo Errormsg();//php scope of the function
          echo Successmsg();
           ?>

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
       <!-- ===================COMMENTS  Part Starts  -->
       <!-- ===================fetching Existing comments Part Starts  -->



       <span class="FieldInfo">Comments</span>
       <br><br>
       <?php
       global $connectingdb;
       $sql="SELECT * FROM comments
       WHERE post_id='$searchquaryparameter'
       AND status='ON'";
       $stmt=$connectingdb->query($sql);

       while ($DataRows=$stmt->fetch()) {
         $commentdate=$DataRows['datetime'];
         $commentname=$DataRows['name'];
         $commentcontent=$DataRows['comment'];

        ?>
        <div>
          <div class="media commentblock">
            <img class="d-block img-fluid" src="images/index.png" alt="" width="50px" height="50px">
            <div class="media-body ml-2">
              <h6 class="lead"><?php echo $commentname; ?></h6>
              <p class="small"><?php echo $commentdate; ?></p>
              <p><?php echo $commentcontent;  ?></p>
            </div>
          </div>
        </div>
        <hr>
<?php } ?>


       <!-- ===================fetching Existing comments Part Ends  -->
       <div class="">
           <form class="" action="fullpost.php?id=<?php echo $searchquaryparameter ?>" method="post">
             <div class="card mb-3">
               <div class="card-header">
                 <h5 class="Fieldinfo">Share your thoughts of this post</h5>
               </div>
               <div class="card-body">
                 <div class="form-group">
                   <div class="input-group">
                     <div class="input-group-prepend">
                       <span class="input-group-text"><i class="fas fa-user"></i></span>
                       <!-- this will give =the icon for user -->
                     </div>
                     <input class="form-control" type="text" name="commnetername" value="" placeholder="Name">
                   </div>
                 </div>
                 <div class="form-group">
                   <div class="input-group">
                     <div class="input-group-prepend">
                       <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                       <!-- this will give =the icon for user -->
                     </div>
                     <input class="form-control" type="email" name="commenteremail" value="" placeholder="email">
                   </div>
                 </div>
                 <div class="form-group">
                   <textarea name="commenterthoughts" class="form-control" rows="6" cols="80"></textarea>
                 </div>
                 <div class="">
                   <button type="submit" name="Submit" class="btn btn-primary">Submit</button>
                 </div>
               </div>
             </div>
           </form>
         </div>
      <!-- ================================================================================comment section end    -->
      </div>
    </div>
    <!-- main area end -->


    <!-- side area -->
    <div class="col-sm-3" style="min-height:40px;background:lightgrey">


            <div class  ="card mt-4">
                  <div class="card-body">
                    <img src="images/add.webp" class="d-block img-fluid mb-3" alt="">
                    <div class="text-center">
      The Government of India has decided to set up 10,000 new Farmers Producer Organizations (FPOs) across the nation. The FPOs, opened under this scheme, will play an important role in increasing the income of farmers. Their aim is not only to provide better facilities to the farmers but also to make agriculture middlemen free in order to provide them a fair price for their hard work. A budget of Rs 4,496 crore has been earmarked under this scheme.FPO is an organization of farmers, registered under the Companies Act to carry forward agricultural production activities. The Central Govt. will provide financial assistance of Rs 15 lakh to each FPO within three years. These FPOs will be entitled to benefit like a company.              </div>
                  </div>
                </div>
                <br>

                 <div class="card">
                   <div class="card-header bg-primary text-light">
                     <h2 class="lead">Categories</h2>
                     </div>
                     <div class="card-body">
                       <?php
                       global $connectingdb;
                       $sql = "SELECT * FROM category ORDER BY id desc";
                       $stmt = $connectingdb->query($sql);
                       while ($DataRows = $stmt->fetch()) {
                         $CategoryId = $DataRows["id"];
                         $CategoryName=$DataRows["title"];
                        ?>
                       <a href="formembers.php?category=<?php echo $CategoryName; ?>"> <span class="heading"> <?php echo $CategoryName; ?></span> </a><br>
                      <?php } ?>
                   </div>
                 </div>
                 <br>
                 <br>
                 <div class="card">
                  <div class="card-header bg-info text-white">
                    <h2 class="lead"> Recent Posts</h2>
                  </div>
                  <div class="card-body">
                    <?php
                    global $connectingdb;
                    $sql= "SELECT * FROM posts ORDER BY id desc LIMIT 0,5";
                    $stmt= $connectingdb->query($sql);
                    while ($DataRows=$stmt->fetch()) {
                      $Id     = $DataRows['id'];
                      $Title  = $DataRows['title'];
                      $DateTime = $DataRows['datetime'];
                      $Image1 = $DataRows['image1'];
                    ?>
                    <div class="media">
                      <img src="upload/<?php echo htmlentities($Image1); ?>" class="d-block img-fluid align-self-start"  width="90" height="94" alt="">
                      <div class="media-body ml-2">
                      <a style="text-decoration:none;"href="FullPost.php?id=<?php echo htmlentities($Id) ; ?>" target="_blank">  <h6 class="lead"><?php echo htmlentities($Title); ?></h6> </a>
                        <p class="small"><?php echo htmlentities($DateTime); ?></p>
                      </div>
                    </div>
                    <hr>
                    <?php } ?>
                  </div>
                </div>

    </div>
    <br>
    <!-- side area end -->
  </div>
  <br>
</div>






































<!-- ======================================================================================================================= -->
<?php require_once("footer.php"); ?>
