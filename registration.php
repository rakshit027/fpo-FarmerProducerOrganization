<?php require_once("includes/functions.php");?>
<?php require_once("includes/db.php");?>
<?php require_once("includes/sessions.php"); ?>
<!-- ALL INCLUDES UPHERE -->
<?php

$_SESSION["trackingURL"]=$_SERVER["PHP_SELF"];

  // confirm_login();
 ?>

<!-- php code starts -->
<?php
  if (isset($_POST["submit"])) {
    $username=$_POST["username"];
    $password=$_POST["password"];
    $confirmpassword=$_POST["confirmpassword"];
    $mobileno=$_POST["mobileno"];
    $address=$_POST["address"];
    // $admin=$_SESSION["Username"];
  //to get our ZONE time because it will take time in seconds of XAMPP SERVER located
  date_default_timezone_set("Asia/Kolkata");
  $currenttime=time();//to get date we must get the time
  $currentdate=strftime("%B-%d-%Y %H-%M-%S",$currenttime);//this will take 2 Arguments 1-DATE FORMATE and 2-Current time variable

  if (empty($username)||empty($password)||empty($confirmpassword)||empty($mobileno)||empty($address)) {
      $_SESSION["Errormsg"]=" all fields must be filled out";
      redirect_to("registration.php");
    }elseif (strlen($password)<4) {
      $_SESSION["Errormsg"]="password Must be greater than 4 characters";
      redirect_to("registration.php");
    }elseif ($password !== $confirmpassword) {
      $_SESSION["Errormsg"]="Your password does not matches";
      redirect_to("registration.php");
    }
    elseif (checkusernameexistornotmember($username)) {
      $_SESSION["Errormsg"]="username exists.........Try another one";
      redirect_to("registration.php");
    }else {
      //query to ADMINS into the database TABLE::::::::::::::::::::::::
      global $connectingdb;
      $sql = "INSERT INTO members(datetime,m_username,m_password,m_mobileno,m_address,status)";//PDO method used
      $sql.="VALUES(:DateTime,:username,:password,:mobileno,:address,'applied')";//Dummy values used to make it SQL injection free

      $stmt =$connectingdb->prepare($sql);
      //this VARIABLE will need our database connection VARIABLE
      //this stmt var will take that DB variable as OBJECT
      //->      *[meams we are using PDO notation OBJECT]
      //and it will call the PDO method of """"prepare"""" TO prepare our SQL
      //then pass our SQL variable
      //NNNOOOOWWWWWWWWW
      //we bind this values[DUMMY ONES] with the actual values

      $stmt->bindValue(':DateTime',$currentdate);
      $stmt->bindValue(':username',$username);//$stmt var will be considered as an OBJECT bcause of the arrow
      $stmt->bindValue(':password',$password);
      $stmt->bindValue(':mobileno',$mobileno);
      $stmt->bindValue(':address',$address);
      //now take var and aboject and call the PDO method of Object
      $Execute=$stmt->execute();
      if ($Execute) {
        $_SESSION["Successmsg"]="Applied auccessfully successfully Login After approval...";
        //this will shoe the category name with id by a PDO function ABOVE
        //Grab connection and take lastconnection id
        //.$connectingdb->lastinsertId() THIS IS """"""""PDO"""""""" method

        redirect_to("registration.php");
      }else {
        $_SESSION["Errormsg"]="Something went WRONG ";
        redirect_to("registration.php");
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
   <link rel="stylesheet" href="Css/Styles.css">
   <title>LOGIN</title>
 </head>
 <body>
   <!-- NAVBAR -->
   <div style="height:10px; background:#27aae1;"></div>
       <!--ABOVE DIV WILL GET """"BLUE STRIP"""" ABOVE header -->
       <!--to color navbar button add navbar-dark as below   -->
   <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
     <div class="container">
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


       </div>
     </div>
   </nav>
     <div style="height:10px; background:#27aae1;"></div>
     <!-- NAVBAR END -->
     <!-- HEADER -->
     <header class="bg-dark text-white py-3"><!--here padding is used ON ""Y-axis""-->
       <div class="container">
         <div class="row">
         </div>
       </div>
     </header>


<!-- header -->
<header class="bg-dark text-white py-3 "><!--here padding is used ON ""Y-axis""-->
  <div class="container">
    <div class="row">
      <div class="col-md-12">
      <h3><i class="fas fa-user" style="color:yellow;"></i> Register as a Member / Login  </h3>
      </div>
    </div>
  </div>
</header>
<!-- HEADER END -->

<!-- CATEGORY MAIN AREA -->
<section class=" offset-2 w3-container py-2 mb-4">
  <div class="row" style="min-height:600px;background:white;">
    <!-- category div -->
    <div class="offset-lg-1 col-lg-5" style="min-height:auto;background:white;">
      <?php
      echo Errormsg();
      echo Successmsg();
       ?>
      <form class="" action="registration.php" method="post">
        <div class="card-header bg-secondary text-light mb-3">
        <div class="header">
          <h1 style=>Registration Form</h1>
        </div>
        <div class="card-body bg-dark">
          <div class="form-group">
            <label for="title"><span class="FieldInfo text-light">User Name:</span></label>
            <input class="form-control" type="text" name="username" id="username" value="">
          </div>

          <div class="form-group">
            <label for="title"><span class="FieldInfo text-light">Password :</span></label>
            <input class="form-control" type="password" name="password" id="password"  value="">
            </div>
            <div class="form-group">
              <label for="title"><span class="FieldInfo text-light">Confirm Password:</span></label>
              <input class="form-control" type="password" name="confirmpassword" id="confirmpassword" value="">
            </div>
            <div class="form-group">
              <label for="mobileno"><span class="FieldInfo text-light">Mobile No.:</span></label>
              <input class="form-control" type="text" name="mobileno" id="mobileno" value="">
            </div>
            <div class="form-group">
              <label for="address"><span class="FieldInfo text-light">Address:</span></label>
              <textarea class="form-control" id="address" name="address" rows="8" cols="80">
              </textarea>
            </div>

            <div class="row">
              <!-- <div class="col-lg-6 mb-2">
                <a href="dashboard.php" class="btn btn-warning btn-block"><i class="fa fa-arrow-left">&nbsp;&nbsp;</i>
                  Back to Dashboard</a>
              </div> -->
              <div class="offset-3 col-lg-6 mb-2">
                <button type="submit" name="submit" class="btn btn-success btn-block">
                  <i class="fa fa-check">&nbsp;&nbsp;</i>Submit
                </button>
              </div>
              <div class="">
                <a href="memberslogin.php" class="navbar-brand">
                  <p>Already a Member ?</p>
                  FPO.com
                  </a>

              </div>

            </div>
          </div>
        </div>
      </form>


    </div>
    <!-- category div end  -->


    <!-- Existing categories End -->
  </div>

</section>


<!-- CATEGORY MAIN AREA Ends -->




<!-- FOOTER -->
<?php require_once("footer.php") ?>
