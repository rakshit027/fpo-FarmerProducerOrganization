<?php require_once("includes/db.php");?>
<?php require_once("includes/functions.php");?>
<?php require_once("includes/sessions.php");?>

<?php
  if (isset($_GET["id"])) {
    // code...
    $searchqueryparameter=$_GET["id"];
    global $connectingdb;
    $admin=$_SESSION["AdminName"];
    $sql="UPDATE requests SET rstatus='Approved..', approvedby='$admin' WHERE id='$searchqueryparameter'";
    $Execute=$connectingdb->query($sql);
    if ($Execute) {
      $_SESSION["Successmsg"]="Comment approved successfully";
      redirect_to("arequests.php");
    }else {
      $_SESSION["Errormsg"]="Something Went Wrong. Please try again !!";
      redirect_to("arequests.php");
    }
  }
 ?>
