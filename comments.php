    <?php require_once("includes/functions.php");?>
    <?php require_once("includes/db.php");?>
    <?php require_once("includes/sessions.php"); ?>
    <?php require_once("header.php") ?>
    <!-- ============================================================= -->
  <?php
  $_SESSION["trackingURL"]=$_SERVER["PHP_SELF"];
  confirm_login();
 ?>
    <!-- HEADER -->
    <header class="bg-dark text-white py-3"><!--here padding is used ON ""Y-axis""-->
      <div class="container">
        <div class="row">
          <div class="col-md-12">
          <h3><i class="fas fa-comments" style="color:skyblue;"></i>  Manage Comments </h3>
          </div>
        </div>
      </div>
    </header>

    <!-- HEADER END -->
    <br>
    <br>
    <br>
<section class="offset-1 container py-2 mb-4">
  <div class="row" style="min-height:30px;">
    <div class="col-lg-12" style="min-height:400px">
      <?php
      echo Errormsg();//php scope of the function
      echo Successmsg();

       ?>

      <h2>Un-Approved Comments</h2>

      <table class="table table-strip table-hover">
        <thead class="thead-dark">
          <tr>
            <td>Sr no.</td>
            <td>Date/time</td>
            <td>Name</td>
            <td>Comments</td>
            <td>Approve</td>
            <td>Delete</td>
            <td>Details</td>


          </tr>
        </thead>
      <?php
      global $connectingdb;
      $sql="SELECT * FROM comments WHERE status='OFF' ORDER BY id desc";
      $Execute=$connectingdb->query($sql);
      $srno=0;
      while ($DateRows=$Execute->fetch()) {
        // code...
        $commentid=$DateRows["id"];
        $datetimecomment=$DateRows["datetime"];
        $commentername=$DateRows["name"];
        $commentcontent=$DateRows["comment"];
        $commentpostid=$DateRows["post_id"];
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
            <td style="min-width:850px;"><?php echo htmlentities($commentcontent); ?></td>
            <td style="min-width:140px;"><a href="approvecomment.php?id=<?php echo $commentid;  ?>" class="btn btn-success">Approve</a></td>
            <td><a href="deletecomment.php?id=<?php echo $commentid;  ?>" class="btn btn-danger">Delete</a></td>
            <td style="min-width:140px;"><a class="btn btn-primary" href="fullpost.php?id=<?php echo $commentpostid; ?>" target="_blank">Live Preview</a></td>
          </tr>
       </tbody>
     <?php } ?>
      </table>
<hr>
      <h2>Approved Comments</h2>
      <table class="table table-strip table-hover">
        <thead class="thead-dark">
          <tr>
            <td>Sr no.</td>
            <td>Date/time</td>
            <td>Name</td>
            <td>Comments</td>
            <td>Approve</td>
            <td>Delete</td>
            <td>Details</td>
          </tr>
        </thead>


      <?php
      global $connectingdb;
      $sql="SELECT * FROM comments WHERE status='ON' ORDER BY id desc";
      $Execute=$connectingdb->query($sql);
      $srno=0;
      while ($DateRows=$Execute->fetch()) {
        // code...
        $commentid=$DateRows["id"];
        $datetimecomment=$DateRows["datetime"];
        $commentername=$DateRows["name"];
        $commentcontent=$DateRows["comment"];
        $commentpostid=$DateRows["post_id"];
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
            <td style="min-width:850px;"><?php echo htmlentities($commentcontent); ?></td>
            <td style="min-width:150px;"><a href="disapprovecomment.php?id=<?php echo $commentid;  ?>" class="btn btn-warning">Dis-Approve</a></td>
            <td><a href="deletecomment.php?id=<?php echo $commentid;  ?>" class="btn btn-danger">Delete</a></td>
            <td style="min-width:140px;"><a class="btn btn-primary" href="fullpost.php?id=<?php echo $commentpostid; ?>" target="_blank">Live Preview</a></td>
          </tr>
       </tbody>
      <?php } ?>
      </table>
      <hr>

    </div>
  </div>
</section>






    <!-- ===================== FOOTER =====================================-->
    <?php require_once 'footer.php'; ?>
