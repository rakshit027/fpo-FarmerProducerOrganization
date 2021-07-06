<?php require_once("includes/functions.php");?>
<?php require_once("includes/db.php");?>
<?php require_once("includes/sessions.php"); ?>
<?php
$_SESSION["trackingURL"]=$_SERVER["PHP_SELF"];

  mconfirm_login();

 ?>

<!-- //////////////////////////////////////////////////////////////////////////////// -->
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
          <a href="formembers.php?page=<?php echo "0"; ?>" class="nav-link">Home</a>
        </li>
        <li class="nav-item">
          <a href="aboutus.php" class="nav-link">About Us</a>
        </li>
        <li class="nav-item">
          <a href="features.php" class="nav-link">Features</a>
        </li>
        <li class="nav-item">
          <a href="members.php" class="nav-link">Members</a>
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
          <a href="mLogout.php" class="nav-link text-danger">
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



<?php
// $searchqueryparameter=$_GET["id"];

  if (isset($_POST["Submit"])) {
  $rname=$_POST["name"];
  $rtitle=$_POST["title"];
  $rcomment=$_POST["requestinfo"];
  date_default_timezone_set("Asia/Kolkata");
  $currenttime=time();//to get date we must get the time
  $currentdate=strftime("%B-%d-%Y %H-%M-%S",$currenttime);//this will take 2 Arguments 1-DATE FORMATE and 2-Current time variable

  if (empty($rname)||empty($rtitle)||empty($rcomment)) {
    //code For all the validation of categoryTitle
    $_SESSION["Errormsg"]="to send Request all fields must be filled out";
    redirect_to("requests.php?id={$searchquaryparameter}");
  }elseif (strlen($rcomment)>500) {
    $_SESSION["Errormsg"]="comment cahracters should be less than 500 caharacters";
    redirect_to("requests.php?id={$searchquaryparameter}");
  }else {
    //query to add COMMENT into the database TABLE::::::::::::::::::::::::
    global $connectingdb;
    $sql = "INSERT INTO requests(title,name,rstatus,datetime,info)";
    //PDO method used
    $sql.="VALUES(:title,:Name,'Pending',:datetime,:info)";
    //Dummy values used to make it SQL injection free
    $stmt =$connectingdb->prepare($sql);
    $stmt->bindValue(':title',$rtitle);//$stmt var will be considered as an OBJECT bcause of the arrow
    $stmt->bindValue(':Name',$rname);
    $stmt->bindValue(':datetime',$currentdate);
    $stmt->bindValue(':info',$rcomment);
  //  $stmt->bindValue(':rstatus',$searchquaryparameter);
    //now take var and aboject and call the PDO method of Object
    $Execute=$stmt->execute();
    if ($Execute) {
      $_SESSION["Successmsg"]="comment submitted successfully";
      redirect_to("requests.php?id={$searchquaryparameter}");
    }else {
      $_SESSION["Errormsg"]="comments not added !! something went wrong WRONG ";
      redirect_to("requests.php?id={$searchquaryparameter}");
    }
  }
}



 ?>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////// -->

<div class="w-100 p-3 offset-1 col-lg-10 mt-5" style="width: 100px; height: 680px;">
  <?php
  echo Errormsg();//php scope of the function
  echo Successmsg();
   ?>

    <!-- <form class="" action="aboutus.php?id=<?php echo $searchqueryparameter ?>" method="post"> -->
        <div class="w-100 p-3">
          <h4 class="">Farmer Producer Organizations and the Future of Agriculture Marketing Imperatives for inclusive economic
             growth Small Farmers’ Agribusiness Consortium.</h5>
             <hr>
        </div>
        <div class="col-lg ">
          <h5>
            <ul>
    <h4>    <u>Importance of FPO <br> </u>      <br></h3>
            <li>Collective inputs purchase</li>
            <li>Collective marketing</li>
            <li>Processing</li>
            <li>Increasing productivity through better inputs</li>
            <li>Increasing knowledge of farmers</li>
            <li>Ensuring quality</li>
            <li> Marketing assistance</li>
            <li>Technical services</li>
            <li>Saving and credit</li>
            <li>Local development</li>

            </ul>


          </h5>
        </div>


  </div>

<!-- ==================================================================================== -->
</div>
</div>
<?php require_once 'footer.php'; ?>
