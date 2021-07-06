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
  $category=$_POST["categoryTitle"];
  $admin=$_SESSION["Username"];
  //to get our ZONE time because it will take time in seconds of XAMPP SERVER located
  date_default_timezone_set("Asia/Kolkata");
  $currenttime=time();//to get date we must get the time
  $currentdate=strftime("%B-%d-%Y %H-%M-%S",$currenttime);//this will take 2 Arguments 1-DATE FORMATE and 2-Current time variable

  if (empty($category)) {
    //code For all the validation of categoryTitle
    $_SESSION["Errormsg"]="categoryTitle all fields must be filled out";
    redirect_to("categories.php");
  }elseif (strlen($category)<3) {
    $_SESSION["Errormsg"]="categoryTitle Must be greater than 2 characters";
    redirect_to("categories.php");
  }elseif (strlen($category)>49) {
    $_SESSION["Errormsg"]="categoryTitle Must be smaller than 50 characters";
    redirect_to("categories.php");
  }else {
    //query to add categoryTitle into the database TABLE::::::::::::::::::::::::
    global $connectingdb;
    $sql = "INSERT INTO category(title,author,datetime)";
    //PDO method used
    $sql.="VALUES(:categoryName,:adminName,:DateTime)";
    //Dummy values used to make it SQL injection free

    $stmt =$connectingdb->prepare($sql);
    //this VARIABLE will need our database connection VARIABLE
    //this stmt var will take that DB variable as OBJECT
    //->      *[meams we are using PDO OBJECT notation ]
    //and it will call the PDO method of """"prepare"""" TO prepare our SQL
    //then pass our SQL variable
    //NNNOOOOWWWWWWWWW
    //we bind this values[DUMMY ONES] with the actual values
    $stmt->bindValue(':categoryName',$category);//$stmt var will be considered as an OBJECT bcause of the arrow
    $stmt->bindValue(':adminName',$admin);
    $stmt->bindValue(':DateTime',$currentdate);
    //now take var and aboject and call the PDO method of Object
    $Execute=$stmt->execute();
    if ($Execute) {
      $_SESSION["Successmsg"]="Category with id:".$connectingdb->lastinsertId()." added successfully";
      //this will shoe the category name with id by a PDO function ABOVE
      //Grab connection and take lastconnection id
      //.$connectingdb->lastinsertId() THIS IS """"""""PDO"""""""" method
      redirect_to("categories.php");
    }else {
      $_SESSION["Errormsg"]="Something went WRONG ";
      redirect_to("categories.php");
    }
  }
}



 ?>


<!-- header -->
<header class="bg-dark text-white py-3 "><!--here padding is used ON ""Y-axis""-->
  <div class="container">
    <div class="row">
      <div class="col-md-12">
      <h3><i class="fas fa-edit" style="color:yellow;"></i> Manage Categories </h3>
      </div>
    </div>
  </div>
</header>
<!-- HEADER END -->

<!-- CATEGORY MAIN AREA -->
<section class="w3-container py-2 mb-4">
  <div class="row" style="min-height:600px;background:white;">
    <!-- category div -->
    <div class="offset-lg-1 col-lg-5" style="min-height:750px;background:white;">
      <?php
      echo Errormsg();//php scope of the function
      echo Successmsg();
       ?>
      <form class="" action="categories.php" method="post">
        <div class="card-header bg-secondary text-light mb-3">
        <div class="header">
          <h1 style=>Add Category</h1>
        </div>
        <div class="card-body bg-dark">
          <div class="form-group">
            <label for="title"><span class="FieldInfo text-light">Category Title:</span></label>
            <input class="form-control" type="text" name="categoryTitle" id="title" placeholder="type title here" value="">
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
    <div class="col-lg-5" style="min-height:400px;background:#;">

            <h2>Existing Categories</h2>

            <table class="table table-strip table-hover">
              <thead class="thead-dark">
                <tr>
                  <td>Sr no.</td>
                  <td>Date/time</td>
                  <td>Category Name</td>
                  <td>Created By</td>
                  <td>Action</td>


                </tr>
              </thead>
            <?php
            global $connectingdb;
            $sql="SELECT * FROM category ORDER BY id desc";
            $Execute=$connectingdb->query($sql);
            $srno=0;
            while ($DateRows=$Execute->fetch()) {
              // code...
              $categoryid=$DateRows["id"];
              $datetimecategory=$DateRows["datetime"];
              $categoryname=$DateRows["author"];
              $categorycontent=$DateRows["title"];
              $srno++;
              //
              // if (strlen($commentername)>10) { $commentername=substr($commentername,0,10).'...';}
              // if (strlen($datetimecomment)>11) { $datetimecomment=substr($datetimecomment,0,11).'...';}

             ?>
             <tbody>
                <tr>
                  <td><?php echo htmlentities($srno); ?></td>
                  <td><?php echo htmlentities($datetimecategory); ?></td>
                  <td><?php echo htmlentities($categorycontent); ?></td>
                  <td><?php echo htmlentities($categoryname); ?></td>
                  <td><a href="deletecategory.php?id=<?php echo $categoryid;  ?>" class="btn btn-danger">Delete</a></td>
                </tr>
             </tbody>
           <?php } ?>
            </table>
    </div>
    <!-- Existing categories End -->
  </div>

</section>


<!-- CATEGORY MAIN AREA Ends -->




<!-- FOOTER -->
<?php require_once("footer.php") ?>
