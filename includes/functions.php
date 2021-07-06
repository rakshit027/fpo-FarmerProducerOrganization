<!-- TO WORK WITH THE DATABASE WE NEED TO INCLUDE database file -->
<?php require_once("includes/db.php");?>


<!--""""""""""""""""""""""REDIRECT function""""""""" to redirect to new location if CATEGORY -->
<?php
//this $new_location will take a areument such as new.php/category.php/eeettttccccc.php
//it will take webaddress as an argument
function redirect_to($new_location){
  header("Location:".$new_location);
  exit;
}


function checkusernameexistornot($username){
  global $connectingdb;
  $sql = "SELECT username from leader_bod WHERE username=:username";
  $stmt=$connectingdb->prepare($sql);
  $stmt->bindValue(':username',$username);
  $stmt->execute();
  $result=$stmt->rowcount();
  // called the method of pdo to count ROWS
  if ($result==1) {
    return true;
  }else {
    return false;
  }

}

function checkusernameexistornotmember($username){
  global $connectingdb;
  $sql = "SELECT username from members WHERE username=:username";
  $stmt=$connectingdb->prepare($sql);
  $stmt->bindValue(':username',$username);
  $stmt->execute();
  $result=$stmt->rowcount();
  // called the method of pdo to count ROWS
  if ($result==1) {
    return true;
  }else {
    return false;
  }

}


function login_attempt($username,$password){

        global $connectingdb;
        $sql="SELECT * FROM leader_bod WHERE username=:username AND password=:passWord LIMIT 1";
        $stmt=$connectingdb->prepare($sql);
        $stmt->bindValue(':username',$username);
        $stmt->bindValue(':passWord',$password);
        $stmt->execute();
        $result=$stmt->rowcount();
        if ($result==1) {
          return $account_found=$stmt->fetch();
        } else {
          return null;
        }

}
///////////////////////////////////////////////////////////////////////////////////////////
function memberlogin_attempt($username,$password){

        global $connectingdb;
        $sql="SELECT * FROM members WHERE m_username=:username AND m_password=:passWord LIMIT 1";
        $stmt=$connectingdb->prepare($sql);
        $stmt->bindValue(':username',$username);
        $stmt->bindValue(':passWord',$password);
        $stmt->execute();
        $result=$stmt->rowcount();
        if ($result==1) {
          return $account_found=$stmt->fetch();
        } else {
          return null;
        }

}







////////////////////////////////////////////////////////////////////////////////////////////
function mlogin_attempt($username,$password){

        global $connectingdb;
        $sql="SELECT * FROM members WHERE m_username=:username AND m_password=:passWord AND status='yes' LIMIT 1";
        $stmt=$connectingdb->prepare($sql);
        $stmt->bindValue(':username',$username);
        $stmt->bindValue(':passWord',$password);
        $stmt->execute();
        $result=$stmt->rowcount();
        if ($result==1) {
          return $account_found=$stmt->fetch();
        } else {
          return null;
        }

}


function confirm_login(){

  if (isset($_SESSION["user_id"])) {
    // code...
    return true;
  }else {
    $_SESSION["Errormsg"]="Login required";
    redirect_to("login.php");
  }
}

function mconfirm_login(){

  if (isset($_SESSION["muser_id"])) {
    // code...
    return true;
  }else {
    $_SESSION["Errormsg"]="Login required";
    redirect_to("memberslogin.php");
  }
}


function totalposts(){

    global $connectingdb;
    $sql="SELECT COUNT(*) FROM posts";//count clause of SQL [[it will retur the total number of rows]]
    $stmt=$connectingdb->query($sql);
    $totalrows=$stmt->fetch();
    //echo $totalrows;
    // we need to convert array data into string to echo it
    $totalposts=array_shift($totalrows);
    echo $totalposts;
}
function totalcategories(){
  global $connectingdb;
  $sql="SELECT COUNT(*) FROM category";
  $stmt=$connectingdb->query($sql);
  $totalrows=$stmt->fetch();
  $totalcategory=array_shift($totalrows);
  echo $totalcategory;
}
function totaladmins(){
  global $connectingdb;
  $sql="SELECT COUNT(*) FROM leader_bod";
  $stmt=$connectingdb->query($sql);
  $totalrows=$stmt->fetch();
  $totaladmins=array_shift($totalrows);
  echo $totaladmins;

}


function totalmembers(){
  global $connectingdb;
  $sql="SELECT COUNT(*) FROM members";
  $stmt=$connectingdb->query($sql);
  $totalrows=$stmt->fetch();
  $totaladmins=array_shift($totalrows);
  echo $totaladmins;

}




















function totalcomments(){
  global $connectingdb;
  $sql="SELECT COUNT(*) FROM comments";
  $stmt=$connectingdb->query($sql);
  $totalrows=$stmt->fetch();
  $totalcomments=array_shift($totalrows);
  echo $totalcomments;
}


function approvecommentsofpost($postid){

  global $connectingdb;
  $sql1="SELECT COUNT(*) FROM comments WHERE post_id='$postid' AND status='ON'";
  $stmt1=$connectingdb->query($sql1);
  $totalrows=$stmt1->fetch();
  $total1=array_shift($totalrows);
  return $total1;

}
function Disapprovecommentsofpost($postid){
  global $connectingdb;
  $sql2="SELECT COUNT(*) FROM comments WHERE post_id='$postid' AND status='OFF'";
  $stmt2=$connectingdb->query($sql2);
  $totalrows=$stmt2->fetch();
  $total2=array_shift($totalrows);
  return $total2;

}


function totalrequests(){
  global $connectingdb;
  $sql="SELECT COUNT(*) FROM requests";
  $stmt=$connectingdb->query($sql);
  $totalrows=$stmt->fetch();
  $totalcomments=array_shift($totalrows);
  echo $totalcomments;
}
























?>
