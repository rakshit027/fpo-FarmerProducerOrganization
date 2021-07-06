<?php require_once("includes/db.php");?>
<?php require_once("includes/functions.php");?>
<?php require_once("includes/sessions.php");?>

<?php
  if (isset($_GET["id"])) {
    // code...
    $searchqueryparameter=$_GET["id"];
    global $connectingdb;
    // $admin=$_SESSION["AdminName"];
    $sql="DELETE FROM leader_bod WHERE id='$searchqueryparameter'";
    $Execute=$connectingdb->query($sql);
    if ($Execute) {
      $_SESSION["Successmsg"]="Admin Deleted successfully";
      redirect_to("admins.php");
    }else {
      $_SESSION["Errormsg"]="Something Went Wrong. Please try again !!";
      redirect_to("admins.php");
    }
  }
 ?>
