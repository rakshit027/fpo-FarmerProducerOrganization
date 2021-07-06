<?php require_once("includes/functions.php");?>
<?php require_once("includes/db.php");?>
<?php require_once("header.php") ?>
<?php require_once("includes/sessions.php"); ?>
<!-- //////////////////////////////////////////////////////////////////////////////// -->
<?php
$_SESSION["trackingURL"]=$_SERVER["PHP_SELF"];

  confirm_login();

 ?>


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

<div class="offset-1 col-lg-6 mt-5">
  <h1>Manage New Registrations</h1>
  <table class="table table-strip table-hover">
    <thead class="thead-dark">
      <tr>
        <td>Sr no.</td>
        <td>Date/time</td>
        <td>User Name</td>
        <td>Mobile No.</td>
        <td>Address</td>
        <td>Approve</td>
        <td>Delete</td>



      </tr>
    </thead>
  <?php
  global $connectingdb;
  $sql="SELECT * FROM members WHERE status='applied' ORDER BY id desc";
  $Execute=$connectingdb->query($sql);
  $srno=0;
  while ($DateRows=$Execute->fetch()) {
    // code...
    $commentid=$DateRows["id"];
    $datetimecomment=$DateRows["datetime"];
    $commentername=$DateRows["m_username"];
    $commentertitle=$DateRows["m_mobileno"];
    $commentcontent=$DateRows["m_address"];
    $commentpostid=$DateRows["status"];
    $srno++;
    //
    // if (strlen($commentername)>10) { $commentername=substr($commentername,0,10).'...';}
    // if (strlen($datetimecomment)>11) { $datetimecomment=substr($datetimecomment,0,11).'...';}

   ?>
   <tbody>
      <tr>
        <td><?php echo htmlentities($srno); ?></td>
        <td><?php echo htmlentities($datetimecomment); ?></td>
        <td><?php echo htmlentities($commentername); ?></td>
        <td><?php echo htmlentities($commentertitle); ?></td>
        <td><?php echo htmlentities($commentcontent); ?></td>
        <td style="min-width:140px;"><a href="approvemember.php?id=<?php echo $commentid;  ?>" class="btn btn-success">Approve</a></td>
        <td style="min-width:140px;"><a href="deletemember.php?id=<?php echo $commentid;  ?>" class="btn btn-danger">Delete</a></td>
      </tr>
   </tbody>
  <?php } ?>
  </table>
  <hr>

</div>


<div class="offset-1 col-lg-5" style="min-height:750px;background:#;">
  <!-- =============================for existing admins ========================================= -->
  <h2>Existing Members</h2>

                  <table class="table table-strip table-hover bg-light">
                    <thead class="thead-dark">
                      <tr>
                        <td>Sr no.</td>
                        <td>Date/time</td>
                        <td>User Name</td>
                        <td>Contact no.</td>
                        <td>Address</td>
                        <td>Action</td>


                      </tr>
                    </thead>
                  <?php
                  global $connectingdb;
                  $sql="SELECT * FROM members ORDER BY id desc";
                  $Execute=$connectingdb->query($sql);
                  $srno=0;
                  while ($DateRows=$Execute->fetch()) {
                    // code...
                    $adminid=$DateRows["id"];
                    $datetimeadmin=$DateRows["datetime"];
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












<br><br><br><br><br><br>
<br><br><br><br><br><br>
<br><br><br><br><br><br>
<?php require_once 'footer.php'; ?>
