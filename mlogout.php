<?php require_once("includes/functions.php");?>
<?php require_once("includes/sessions.php");?>

<?php


  $_SESSION["muser_id"]=null;
  $_SESSION["mUsername"]=null;
  $_SESSION["mAdminName"]=null;
//  session_destroy();

  // unset($_SESSION["muser_id"] && $_SESSION["Username"] && $_SESSION["AdminName"] );

  unset($_SESSION["muser_id"]);
  unset($_SESSION["mUsername"]);
  // unset($_SESSION["mAdminName"]);

  redirect_to("memberslogin.php");


?>
