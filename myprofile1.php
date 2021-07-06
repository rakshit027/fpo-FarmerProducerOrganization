<?php require_once("includes/functions.php");?>
<?php require_once("includes/db.php");?>
<?php require_once("header.php") ?>
<?php require_once("includes/sessions.php"); ?>
<!-- ALL INCLUDES UPHERE -->
<?php
  confirm_login();
 ?>
<!-- php code starts -->
<?php

$adminid=$_SESSION["user_id"];
// echo Errormsg();//php scope of the function
// echo Successmsg();
global $connectingdb;
$sql="SELECT * FROM leader_bod WHERE id='$adminid'";
$stmt=$connectingdb->query($sql);
while ($DateRows = $stmt->fetch()) {
  $existingusername=$DateRows["username"];
  $eaname=$DateRows["aname"];
  $eaddress=$DateRows["address"];
  $elocation=$DateRows["location"];
  $ebio=$DateRows["bio"];
  $eemail=$DateRows["email"];
  $ephoneno=$DateRows["phoneno"];
  $eimage=$DateRows["image"];

}
  if (isset($_POST["submit"])) {
    $name=$_POST["Name"];
    $aname=$_POST["aName"];
    $email=$_POST["email"];
    $mobno=$_POST["mobno"];
    $address=$_POST["address"];
    $location=$_POST["location"];
    $newbio=$_POST["bio"];//displays the bio of user
    $Images1=$_FILES["images1"]["name"]; // this will only save the image name in the database and IMAGE in seperate Directory
    $Target1="images/".basename($_FILES["images1"]["name"]);//target file with FUNCTION basefile() that will take base bile as an Arguments
// ///////////////////////////////////////////////////////////

// if (!empty($_FILES["images1"]["name"])) {
// $sql = "UPDATE leader_bod
//         SET username='$name',image='$Images1',aname='$aname',address='$address',location='$location',bio='$newbio',email='$email',phoneno='$mobno'
//         WHERE id='$adminid'";
// }else {
//         $sql = "UPDATE leader_bod SET username=:Name WHERE id='$adminid'";
//       }

  global $connectingdb;
  if (!empty($_FILES["images1"]["name"])) {
    // code...
    $sql="UPDATE leader_bod SET username='$name',bio='$newbio',image='$Images1' WHERE id='$adminid'";
  } else {
    // code...
    $sql="UPDATE leader_bod SET username='$name',bio='$newbio',aname='$aname',address='$address',location='$location',email='$email',phoneno='$mobno' WHERE id='$adminid'";

    // redirect_to("myprofile1.php");
  }
  $Execute=$connectingdb->query($sql);

    if ($Execute) {
      $_SESSION["Successmsg"]="profile updated successfully";
      redirect_to("myprofile1.php");
    }else {
      $_SESSION["Errormsg"]="Something went WRONG TRY... Again ";
      redirect_to("myprofile1.php");
    }
  }


 ?>


<!-- header -->
<header class="bg-dark text-white py-3 "><!--here padding is used ON ""Y-axis""-->
  <div class="container">
    <div class="row">
      <div class="col-md-12">
      <h3><i class="fas fa-user mr-2" style="color:white;"></i> My Profile </h3>
      </div>
    </div>
  </div>
</header>
<!-- HEADER END -->

<!-- CATEGORY MAIN AREA -->
<section class="container py-2 mb-4">
  <div class="row" style="min-height:50px;background:white;">
    <!-- LEFT area -->
    <div class="col-md-3" style="background:#;">
      <div class="card">
        <div class="card-header bg-dark text-light">
          <h3>@<?php echo $existingusername ?></h3>
        </div>
        <div class="card-body">
          <img src="images/<?php echo "$eimage"; ?>" class="block img-fluid mb-3" alt="NO PROFILE PICTURE">
          <br><br>
          <div class="">
            <?php echo $ebio; ?>
          </div>
        </div>
      </div>

    </div>
    <!-- Left Area End -->
    <!-- roght area starts -->
    <div class="col-md-9" style="min-height:400px;background:white;">
      <?php
      echo Errormsg();//php scope of the function
      echo Successmsg();
       ?>
      <!--FORM      -->
      <form class="" action="myprofile1.php" method="post" enctype="multipart/form-data">
        <div class="card-header bg-secondary text-light mb-3">
          <div class="card-header">
            <h2>Edit Profile</h4>
          </div>
        <div class="card-body bg-dark">
          <!-- THIS WILL input post title -->
          <div class="form-group">
            <label for="title"><span class="FieldInfo text-light">User Name :</span></label>
            <input class="form-control" type="text" name="Name" id="title" placeholder="your name here" value="<?php echo $existingusername ?>">
            <!-- <small class="text-muted"> Add your OCcupation Description </small> -->
          </div>
          <div class="form-group">
            <label for="title"><span class="FieldInfo text-light">Alias Name :</span></label>
            <input class="form-control" type="text" name="aName" id="title" placeholder="alias name " value="<?php echo $eaname; ?>">
            <!-- <div class="col-lg-1 mb-1">
              <button type="submit" name="submit" class="btn btn-success">
                <i class="fa fa-star"></i>
              </button>
            </div> -->
            <!-- <small class="text-muted"> Add your OCcupation Description </small> -->
          </div>
          <!-- <div class="form-group"> -->
            <!-- <label for="title"><span class="FieldInfo text-light">Post title :</span></label> -->
            <!-- <input class="form-control" type="text" name="Occupation" placeholder="Occupation" value=""> -->
            <!-- <small class="text-muted"> Add your OCcupation Description </small> -->
          <!-- </div> -->
          <div class="form-group">
            <label for="email"><span class="FieldInfo text-light">e-mail:</span></label>
            <input class="form-control" type="text" name="email" id="email" placeholder="email here" value="<?php echo $eemail; ?>">
          </div>
          <div class="form-group">
            <label for="no"><span class="FieldInfo text-light">Mobile no.:</span></label>
            <input class="form-control" type="text" name="mobno" id="no" placeholder="your contact details here" value="<?php echo $ephoneno; ?>">
          </div>
          <div class="form-group">
            <label for="add"><span class="FieldInfo text-light">Address:</span></label>
            <input class="form-control" type="text" name="address" id="add" placeholder="your address here" value="<?php echo $eaddress; ?>">
          </div>
          <div class="form-group">
            <label for="title"><span class="FieldInfo text-light">Location:</span></label>
            <input class="form-control" type="text" name="location" id="title" placeholder="location here" value="<?php echo $elocation; ?>">
          </div>



          <!-- /////////////////////////// -->
          <div class="form-group">
            <label for="bioa"><span class="FieldInfo text-light">Your BIO :</span></label>
            <textarea placeholder="Bio." id="bioa" name="bio" rows="8" cols="80" value="">
              <?php echo $ebio; ?>
            </textarea>
          </div>
          <!-- ////////////////////// -->


            <!-- This will give the dropdown list below from DB-->

            <!-- make a label for input id to select file/photo file  -->
              <div class="form-group">
                <label for="imageselect"><span class="FieldInfo text-light">Select Your Profile Image :</span></label>
                <div class="custom-file mb-1">
                  <input type="file" name="images1" value="" id="imageselect" class="custom-file-input"><!-- //here class is necessary in the input field -->
                  <label for="imageselect" class="custom-file-label">select image ----></label>
                </div>
              </div>


              <!-- this will be the text area of our post with id and label -->
              <!-- this will be the back buttons -->
            <div class="row">
              <div class="col-lg-6 mb-2">
                <a href="dashboard.php" class="btn btn-warning btn-block"><i class="fa fa-arrow-left"></i>Back to Dashboard</a>
              </div>
              <!-- this will submit the field -->
              <div class="col-lg-6 mb-2">
                <button type="submit" name="submit" class="btn btn-success btn-block">
                  <i class="fa fa-check"></i>Update
                </button>
              </div>

            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>



<!-- CATEGORY MAIN AREA Ends -->




<!-- FOOTER -->
<?php require_once("footer.php") ?>
