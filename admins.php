<?php require_once("includes/functions.php");?>
<?php require_once("includes/db.php");?>
<?php require_once("header.php") ?>
<?php require_once("includes/sessions.php"); ?>
<!-- ALL INCLUDES UPHERE -->
<?php

$_SESSION["trackingURL"]=$_SERVER["PHP_SELF"];

  confirm_login();
 ?>

<!-- php code starts -->
<?php
  if (isset($_POST["submit"])) {
    $username=$_POST["username"];
    $Name=$_POST["name"];
    $password=$_POST["password"];
    $confirmpassword=$_POST["confirmpassword"];
    $admin=$_SESSION["Username"];
  //to get our ZONE time because it will take time in seconds of XAMPP SERVER located
  date_default_timezone_set("Asia/Kolkata");
  $currenttime=time();//to get date we must get the time
  $currentdate=strftime("%B-%d-%Y %H-%M-%S",$currenttime);//this will take 2 Arguments 1-DATE FORMATE and 2-Current time variable

  if (empty($username)||empty($password)||empty($confirmpassword)) {
      $_SESSION["Errormsg"]=" all fields must be filled out";
      redirect_to("admins.php");
    }elseif (strlen($password)<4) {
      $_SESSION["Errormsg"]="password Must be greater than 4 characters";
      redirect_to("admins.php");
    }elseif ($password !== $confirmpassword) {
      $_SESSION["Errormsg"]="Your password does not matches";
      redirect_to("admins.php");
    }
    elseif (checkusernameexistornot($username)) {
      $_SESSION["Errormsg"]="username exists.........Try another one";
      redirect_to("admins.php");
    }else {
      //query to ADMINS into the database TABLE::::::::::::::::::::::::
      global $connectingdb;
      $sql = "INSERT INTO leader_bod(datetime,username,password,aname,addedby)";//PDO method used
      $sql.="VALUES(:DateTime,:username,:password,:aname,:adminName)";//Dummy values used to make it SQL injection free

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
      $stmt->bindValue(':aname',$Name);
      $stmt->bindValue(':adminName',$admin);
      //now take var and aboject and call the PDO method of Object
      $Execute=$stmt->execute();
      if ($Execute) {
        $_SESSION["Successmsg"]="new BOD $username added  successfully";
        //this will shoe the category name with id by a PDO function ABOVE
        //Grab connection and take lastconnection id
        //.$connectingdb->lastinsertId() THIS IS """"""""PDO"""""""" method

        redirect_to("admins.php");
      }else {
        $_SESSION["Errormsg"]="Something went WRONG ";
        redirect_to("admins.php");
      }
    }
  }


 ?>


<!-- header -->
<header class="bg-dark text-white py-3 "><!--here padding is used ON ""Y-axis""-->
  <div class="container">
    <div class="row">
      <div class="col-md-12">
      <h3><i class="fas fa-user" style="color:yellow;"></i> Manage BOD </h3>
      </div>
    </div>
  </div>
</header>
<!-- HEADER END -->

<!-- CATEGORY MAIN AREA -->
<section class="w3-container py-2 mb-4">
  <div class="row" style="min-height:600px;background:white;">
    <!-- category div -->
    <div class="offset-lg-1 col-lg-5" style="min-height:400px;background:white;">
      <?php
      echo Errormsg();
      echo Successmsg();
       ?>
      <form class="" action="admins.php" method="post">
        <div class="card-header bg-secondary text-light mb-3">
        <div class="header">
          <h1 style=>Add New BOD/Admins</h1>
        </div>
        <div class="card-body bg-dark">
          <div class="form-group">
            <label for="title"><span class="FieldInfo text-light">User Name:</span></label>
            <input class="form-control" type="text" name="username" id="username" value="">
          </div>
          <div class="form-group">
            <label for="title"><span class="FieldInfo text-light">Name:</span></label>
            <input class="form-control mb-1" type="text" name="name" id="username" value="">
            <small class="text-white text-muted">*****Optional</small>
          </div>
          <div class="form-group">
            <label for="title"><span class="FieldInfo text-light">Password :</span></label>
            <input class="form-control" type="password" name="password" id="password"  value="">
            </div>
            <div class="form-group">
              <label for="title"><span class="FieldInfo text-light">Confirm Password:</span></label>
              <input class="form-control" type="password" name="confirmpassword" id="confirmpassword" value="">
            </div>
            <div class="row">
              <div class="col-lg-6 mb-2">
                <a href="dashboard.php" class="btn btn-warning btn-block"><i class="fa fa-arrow-left">&nbsp;&nbsp;</i>
                  Back to Dashboard</a>
              </div>
              <div class="col-lg-6 mb-2">
                <button type="submit" name="submit" class="btn btn-success btn-block">
                  <i class="fa fa-check">&nbsp;&nbsp;</i>Add
                </button>
              </div>
            </div>
          </div>
        </div>
      </form>

    </div>
    <!-- category div end  -->

    <!-- existing categories -->
    <div class="col-lg-5" style="min-height:750px;background:#;">
      <!-- =============================for existing admins ========================================= -->
      <h2>Existing Admins</h2>

                      <table class="table table-strip table-hover bg-light">
                        <thead class="thead-dark">
                          <tr>
                            <td>Sr no.</td>
                            <td>Date/time</td>
                            <td>User Name</td>
                            <td>Admin Name</td>
                            <td>Added By</td>
                            <td>Action</td>


                          </tr>
                        </thead>
                      <?php
                      global $connectingdb;
                      $sql="SELECT * FROM leader_bod ORDER BY id desc";
                      $Execute=$connectingdb->query($sql);
                      $srno=0;
                      while ($DateRows=$Execute->fetch()) {
                        // code...
                        $adminid=$DateRows["id"];
                        $datetimeadmin=$DateRows["datetime"];
                        $usernameadmin=$DateRows["username"];
                        $anameadmin=$DateRows["aname"];
                        $addedby=$DateRows["addedby"];
                        $srno++;
                        //
                        // if (strlen($commentername)>10) { $commentername=substr($commentername,0,10).'...';}
                        // if (strlen($datetimecomment)>11) { $datetimecomment=substr($datetimecomment,0,11).'...';}

                       ?>
                       <tbody>
                          <tr>
                            <td><?php echo htmlentities($srno); ?></td>
                            <td><?php echo htmlentities($datetimeadmin); ?></td>
                            <td><?php echo htmlentities($usernameadmin); ?></td>
                            <td><?php echo htmlentities($anameadmin); ?></td>
                            <td><?php echo htmlentities($addedby); ?></td>
                            <td><a href="deleteadmin.php?id=<?php echo $adminid;  ?>" class="btn btn-danger">Delete</a></td>
                          </tr>
                       </tbody>
                     <?php } ?>
                      </table>




      <!-- =============================for existing admins Ends========================================= -->



    </div>
    <!-- Existing categories End -->
  </div>

</section>


<!-- CATEGORY MAIN AREA Ends -->




<!-- FOOTER -->
<?php require_once("footer.php") ?>
