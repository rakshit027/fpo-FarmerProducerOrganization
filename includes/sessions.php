<?php
session_start();

function Errormsg(){
  if (isset($_SESSION["Errormsg"])) {
    // code...
    $output="<div class=\"alert alert-danger\">";//when we use double QUOTES in double quotes we need an ESCAPE sequnce "\"\"\"\"\"
    $output.=htmlentities($_SESSION["Errormsg"]);//CONCATNET IT
    $output.="</div>";//CLOSE IT
    $_SESSION["Errormsg"]=null;//MUST make it null because it will not go after next page reload
    return $output;

  }
}
function Successmsg(){
  if (isset($_SESSION["Successmsg"])) {
    // code...
    $output="<div class=\"alert alert-success\">";//when we use double QUOTES in double quotes we need an ESCAPE sequnce "\"\"\"\"\"
    $output.=htmlentities($_SESSION["Successmsg"]);//CONCATNET IT
    $output.="</div>";//CLOSE IT
    $_SESSION["Successmsg"]=null;//will not show this message when CATEGORY,.php start
    return $output;

  }
}

 ?>
