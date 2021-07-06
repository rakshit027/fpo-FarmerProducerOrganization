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
$searchqueryparameter=$_GET["id"];
  if (isset($_POST["submit"])) {
    global $connectingdb;
    $sql="DELETE FROM posts WHERE id='$searchqueryparameter'";
    $Execute=$connectingdb->query($sql);
    // var_dump($Execute);
    if ($Execute) {
      $_SESSION["Successmsg"]="post Deleted successfully";
      redirect_to("posts.php");
    }else {
      $_SESSION["Errormsg"]="Something went WRONG try again";
      redirect_to("posts.php");
    }
  }
 ?>


<!-- header -->
<header class="bg-dark text-white py-3 "><!--here padding is used ON ""Y-axis""-->
  <div class="container">
    <div class="row">
      <div class="col-md-12">
      <h3><i class="fas fa-edit" style="color:yellow;"></i> Delete post </h3>
      </div>
    </div>
  </div>
</header>
<!-- HEADER END -->

<!-- CATEGORY MAIN AREA -->
<section class="container py-2 mb-4">
  <div class="row" style="min-height:50px;background:white;">
    <div class="offset-lg-1 col-lg-10" style="min-height:400px;background:white;">
      <?php
      echo Errormsg();//php scope of the function
      echo Successmsg();
      global $connectingdb;
      $sql="SELECT * FROM posts WHERE id='$searchqueryparameter'";
      $stmt=$connectingdb->query($sql);
      while ($DataRows=$stmt->fetch()) {
        // code...
        $titleupdate=$DataRows["title"];
        $categoryupdate=$DataRows["category"];
        $imageupdate1=$DataRows["image1"];
        $imageupdate2=$DataRows["image2"];
        $postTextupdate=$DataRows["post"];
        // NOW PUT THIS EXTRACTED DATA INTO EVERY ""INPUT field in the form below""
      }


       ?>
      <!--FORM      -->
      <form class="" action="deletepost.php?id=<?php echo $searchqueryparameter; ?>" method="post" enctype="multipart/form-data">
        <div class="card-header bg-secondary text-light mb-3">
        <div class="card-body bg-dark">
          <!-- THIS WILL input post title -->
          <div class="form-group">
            <label for="title"><span class="FieldInfo text-light">Post title :</span></label>
            <input disabled class="form-control" type="text" name="posttitle" id="title" placeholder="type title here" value="<?php echo $titleupdate; ?>">
            </div>
            <hr color="white">

            <!-- This will give the dropdown list below from DB-->
            <div class="form-group">
              <span class="FieldInfo text-light">Existing Category:</span>
              <?php echo $categoryupdate; ?>
              <br><br>
            </div>
              <hr color="white">

            <!-- make a label for input id to select file/photo file  -->
              <div class="form-group">
                <span class="FieldInfo text-light">Existing Images:</span>
                <img src="upload/<?php echo $imageupdate1; ?>" alt="" width="170px" height="100px"/>
                <img src="upload/<?php echo $imageupdate2; ?>" alt="" width="170px" height="100px"/>
                <br><br>

              </div>

              <hr color="white">

              <!-- this will be the text area of our post with id and label -->
              <div class="form-group">
                <label for="post"><span class="FieldInfo text-light">Post :</span></label>
                <textarea disabled class="form-control" id="post" name="postdescription" rows="8" cols="80">
                  <?php echo $postTextupdate; ?>
                </textarea>
              </div>
              <!-- this will be the back buttons -->
            <div class="row">
              <div class="col-lg-6 mb-2">
                <a href="dashboard.php" class="btn btn-warning btn-block"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back to Dashboard</a>
              </div>
              <!-- this will submit the field -->
              <div class="col-lg-6 mb-2">
                <button type="submit" name="submit" class="btn btn-danger btn-block">
                  <i class="fa fa-trash"></i>&nbsp;&nbsp;Delete
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
