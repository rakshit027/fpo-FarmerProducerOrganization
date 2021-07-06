<?php require_once("includes/functions.php");?>
<?php require_once("includes/db.php");?>
<?php require_once("includes/sessions.php"); ?>
<!-- //////////////////////////////////////////////////////////////////////////////// -->
<?php
$_SESSION["trackingURL"]=$_SERVER["PHP_SELF"];

  mconfirm_login();

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
           <a href="mlogout.php" class="nav-link text-danger">
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



<div class="offset-1 col-lg-5 mt-5" style="min-height:100px;background:#;">
  <!-- =============================for existing admins ========================================= -->
  <h2>Existing Members</h2>

                  <table class="table table-strip table-hover bg-light">
                    <thead class="thead-dark" style="background:lightblue;">
                      <tr>
                        <td>Sr no.</td>
                        <!-- <td>Date/time</td> -->
                        <td>User Name</td>
                        <!-- <td>Admin Name</td> -->
                        <td>contact No.</td>
                        <td>Location</td>


                      </tr>
                      <br>
                    </thead>
                  <?php
                  global $connectingdb;
                  $sql="SELECT * FROM members ORDER BY id desc";
                  $Execute=$connectingdb->query($sql);
                  $srno=0;
                  while ($DateRows=$Execute->fetch()) {
                    // code...
                    $adminid=$DateRows["id"];
                    $datetimeadmin=$DateRows["m_location"];
                    $usernameadmin=$DateRows["m_username"];
                    $anameadmin=$DateRows["m_mobileno"];
                    $addedby=$DateRows["m_address"];
                    $srno++;
                    //
                    // if (strlen($commentername)>10) { $commentername=substr($commentername,0,10).'...';}
                    // if (strlen($datetimecomment)>11) { $datetimecomment=substr($datetimecomment,0,11).'...';}

                   ?>
                   <tbody>
                      <tr>
                        <td><?php echo htmlentities($srno); ?></td>
                        <td><?php echo htmlentities($usernameadmin); ?></td>
                        <td><?php echo htmlentities($anameadmin); ?></td>
                        <td><?php echo htmlentities($datetimeadmin); ?></td>

                        <!-- <td><?php echo htmlentities($addedby); ?></td> -->
                        <!-- <td><a href="deleteadmin.php?id=<?php echo $adminid;  ?>" class="btn btn-danger">Delete</a></td> -->
                      </tr>
                   </tbody>
                 <?php } ?>
                  </table>




  <!-- =============================for existing admins Ends========================================= -->



</div>












<br><br><br><br><br><br>
<br><br><br><br><br><br>
<br><br><br><br><br><br>
<?php require_once 'footer.php'; ?>
