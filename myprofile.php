<?php require_once("includes/functions.php");?>
<?php require_once("includes/db.php");?>
<?php require_once("includes/sessions.php"); ?>
<!-- ALL INCLUDES UPHERE -->
<?php
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

<!-- php code starts -->
<?php

$adminid=$_SESSION["muser_id"];
// echo Errormsg();//php scope of the function
// echo Successmsg();
global $connectingdb;
$sql="SELECT * FROM members WHERE id='$adminid'";
$stmt=$connectingdb->query($sql);
while ($DateRows = $stmt->fetch()) {
  $existingusername=$DateRows["m_username"];
  $emobno=$DateRows["m_mobileno"];
  $eaddress=$DateRows["m_address"];
  $elocation=$DateRows["m_location"];
  $ebio=$DateRows["m_bio"];
  $eemail=$DateRows["m_email"];
  // $ephoneno=$DateRows["phoneno"];
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
// $sql = "UPDATE members
//         SET m_username='$name',image='$Images1',aname='$aname',address='$address',location='$location',bio='$newbio',email='$email',phoneno='$mobno'
//         WHERE id='$adminid'";
// }else {
//         $sql = "UPDATE members SET m_username=:Name WHERE id='$adminid'";
//       }

  global $connectingdb;
  if (!empty($_FILES["images1"]["name"])) {
    // code...
    $sql="UPDATE members SET m_username='$name',m_bio='$newbio',image='$Images1' WHERE id='$adminid'";
  } else {
    // code...
    $sql="UPDATE members SET m_username='$name',m_bio='$newbio',m_address='$address',m_location='$location',m_email='$email',m_mobileno='$mobno' WHERE id='$adminid'";

    // redirect_to("myprofile1.php");
  }
  $Execute=$connectingdb->query($sql);

    if ($Execute) {
      $_SESSION["Successmsg"]="profile updated successfully";
      redirect_to("myprofile.php");
    }else {
      $_SESSION["Errormsg"]="Something went WRONG TRY... Again ";
      redirect_to("myprofile.php");
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
          <img src="images/<?php echo htmlentities($eimage); ?>" class="block img-fluid mb-3" alt="NO PROFILE PICTURE">
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
      <form class="" action="myprofile.php" method="post" enctype="multipart/form-data">
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
          <!-- <div class="form-group"> -->
            <!-- <label for="title"><span class="FieldInfo text-light">Alias Name :</span></label> -->
            <!-- <input class="form-control" type="text" name="aName" id="title" placeholder="alias name " value="<?php echo $eaname; ?>"> -->
            <!-- <div class="col-lg-1 mb-1">
              <button type="submit" name="submit" class="btn btn-success">
                <i class="fa fa-star"></i>
              </button>
            </div> -->
            <!-- <small class="text-muted"> Add your OCcupation Description </small> -->
          <!-- </div> -->
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
            <input class="form-control" type="text" name="mobno" id="no" placeholder="your contact details here" value="<?php echo $emobno; ?>">
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
                <a href="formembers.php" class="btn btn-warning btn-block"><i class="fa fa-arrow-left"></i>Back to HOME</a>
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
