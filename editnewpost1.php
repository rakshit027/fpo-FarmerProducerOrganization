<?php require_once("includes/functions.php");?>
<?php require_once("includes/db.php");?>
<?php require_once("header.php") ?>
<?php require_once("includes/sessions.php"); ?>
<!-- ALL INCLUDES UPHERE -->

<!-- php code starts -->
<?php
$searchqueryparameter=$_GET["id"];
  if (isset($_POST["submit"])) {

  $posttitle=$_POST["posttitle"];
  $category=$_POST["Category"];
  $Images1=$_FILES["images1"]["name"]; // this will only save the image name in the database and IMAGE in seperate Directory
  $Images2=$_FILES["images2"]["name"]; // this will only save the image name in the database and IMAGE in seperate Directory
  $Target1="upload/".basename($_FILES["images1"]["name"]);//target file with FUNCTION basefile() that will take base bile as an Arguments
  $Target2="upload/".basename($_FILES["images2"]["name"]);//target file with FUNCTION basefile() that will take base bile as an Arguments
  $postText=$_POST["postdescription"];
  $admin='rakshit';
  date_default_timezone_set("Asia/Kolkata");
  $currenttime=time();//to get date we must get the time
  $currentdate=strftime("%B-%d-%Y %H-%M-%S",$currenttime);//this will take 2 Arguments 1-DATE FORMATE and 2-Current time variable

    if (empty($posttitle)) {
    //code For all the validation of categoryTitle
    $_SESSION["Errormsg"]="Title cant be emtpy";
    redirect_to("posts.php");
  }elseif (strlen($posttitle)<5) {
    $_SESSION["Errormsg"]="Title cant be less than 5";
    redirect_to("posts.php");
  }elseif (strlen($posttitle)>999) {
    $_SESSION["Errormsg"]="Post description should be less than 1000 characers";
    redirect_to("posts.php");
  }else {
    //query to UPDATE into the database TABLE::::::::::::::::::::::::
    global $connectingdb;

    if (!empty($_FILES["images1"]["name"])||($_FILES["images2"]["name"])) {
      // code...
      $sql = "UPDATE posts SET title='$posttitle',category='$category',image1='$Images1',image2='$Images2' WHERE id='$searchqueryparameter' ";
      $Execute=$connectingdb->query($sql);

    }else {
      $sql = "UPDATE posts SET title='$posttitle',category='$category' WHERE id='$searchqueryparameter' ";
      $Execute=$connectingdb->query($sql);
    }

    // $sql = "UPDATE posts SET title='$posttitle',category='$category',image1='$Images1',image2='$Images2' WHERE id='$searchqueryparameter' ";
    // $Execute=$connectingdb->query($sql);


    move_uploaded_file($_FILES["images1"]["tmp_name"],$Target1);
    move_uploaded_file($_FILES["images2"]["tmp_name"],$Target2);

    //var_dump($Execute);
    if ($Execute) {
      $_SESSION["Successmsg"]="post UPDATED successfully";
      redirect_to("posts.php");
    }else {
      $_SESSION["Errormsg"]="Something went WRONG try again";
      redirect_to("posts.php");
    }
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
      <form class="" action="editnewpost.php?id=<?php echo $searchqueryparameter; ?>" method="post" enctype="multipart/form-data">
        <div class="card-header bg-secondary text-light mb-3">
        <div class="card-body bg-dark">
          <!-- THIS WILL input post title -->
          <div class="form-group">
            <label for="title"><span class="FieldInfo text-light">Post title :</span></label>
            <input class="form-control" type="text" name="posttitle" id="title" placeholder="type title here" value="<?php echo $titleupdate; ?>">
            </div>
            <hr color="white">

            <!-- This will give the dropdown list below from DB-->
            <div class="form-group">
              <span class="FieldInfo text-light">Existing Category:</span>
              <?php echo $categoryupdate; ?>
              <br><br>
              <label for="categorytitle"><span class="FieldInfo text-light">Choose New Category :</span></label>
              <select class="form-control" name="Category" id="categorytitle">
                <!-- write a php scope to fetch all categoris form the db by QUERY ->PDO method  -->
                <!-- we can update the query according to our need -->
                <?php
                global $connectingdb;
                $sql="SELECT id,title FROM category";
                $stmt=$connectingdb->query($sql);
                while ($DateRows=$stmt->fetch()) {
                  $ID=$DateRows["id"];
                  $Cattitle=$DateRows["title"];

                 ?>
                 <option><?php echo $Cattitle; ?></option>
                 <?php } ?>
                 <!-- must put this } into php scopt to display all category from the While loop -->
              </select>

            </div>
              <hr color="white">

            <!-- make a label for input id to select file/photo file  -->
              <div class="form-group">
                <span class="FieldInfo text-light">Existing Images:</span>
                <img src="upload/<?php echo $imageupdate1; ?>" alt="" width="170px" height="100px"/>
                <img src="upload/<?php echo $imageupdate2; ?>" alt="" width="170px" height="100px"/>
                <br><br>
                <label for="imageselect"><span class="FieldInfo text-light">Select Image :</span></label>
                <div class="custom-file mb-1">
                  <input type="file" name="images1" value="" id="imageselect" class="custom-file-input"/><!-- //here class is necessary in the input field -->
                  <label for="imageselect" class="custom-file-label">select image 1----></label>
                </div>
                <div class="custom-file">
                  <input type="file" name="images2" value="" id="imageselect" class="custom-file-input"><!-- //here class is necessary in the input field -->
                  <label for="imageselect" class="custom-file-label">select image 2----></label>
                </div>

              </div>

              <hr color="white">

              <!-- this will be the text area of our post with id and label -->
              <div class="form-group">
                <label for="post"><span class="FieldInfo text-light">Post :</span></label>
                <textarea class="form-control" id="post" name="postdescription" rows="8" cols="80">
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
                <button type="submit" name="submit" class="btn btn-success btn-block">
                  <i class="fa fa-check"></i>&nbsp;&nbsp;Update
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
