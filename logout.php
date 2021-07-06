<?php require_once("includes/functions.php");?>
<?php require_once("includes/sessions.php");?>

<?php


  $_SESSION["user_id"]=null;
  $_SESSION["Username"]=null;
  $_SESSION["AdminName"]=null;
  // session_destroy();

  // unset($_SESSION["user_id"] && $_SESSION["Username"] && $_SESSION["AdminName"] );
// unset
unset($_SESSION["user_id"]);
unset($_SESSION["Username"]);
unset($_SESSION["AdminName"]);

  redirect_to("login.php");


?>
