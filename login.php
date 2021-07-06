<?php require_once("includes/db.php");?>
<?php require_once("includes/functions.php");?>
<?php require_once("includes/sessions.php");?>
<?php
if (isset($_SESSION["user_id"])) {
  redirect_to("dashboard.php");
  // code...
}
  if (isset($_POST["Submit"])) {
    // code...
    $username=$_POST["Username"];
    $password=$_POST["Password"];
    if (empty($username)||empty($password)) {
      // code...
      $_SESSION["Errormsg"]="All fields must be filled out !!!";
      redirect_to("login.php");
    }else {
      $account_found=login_attempt($username,$password);
      if ($account_found) {
        // code...
        $_SESSION["user_id"]=$account_found["id"];
        $_SESSION["Username"]=$account_found["username"];
        $_SESSION["AdminName"]=$account_found["aname"];
        $_SESSION["Successmsg"]="WELCOME Admin :) ".$_SESSION["Username"];
// if our tracking URL is set it will redirect to URL we etered
        if (isset($_SESSION["trackingURL"])) {
          // code...
          redirect_to("dashboard.php");
        }else {
          redirect_to("dashboard.php");
        }
      }else {
        $_SESSION["Errormsg"]="incorrect UserName/password";
        redirect_to("login.php");
      }


    }
  }

 ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link rel="stylesheet" href="Css/Styles.css">
  <title>LOGIN</title>
</head>
<body>
  <!-- NAVBAR -->
  <div style="height:10px; background:#27aae1;"></div>
      <!--ABOVE DIV WILL GET """"BLUE STRIP"""" ABOVE header -->
      <!--to color navbar button add navbar-dark as below   -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
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


      </div>
    </div>
  </nav>
    <div style="height:10px; background:#27aae1;"></div>
    <!-- NAVBAR END -->
    <!-- HEADER -->
    <header class="bg-dark text-white py-3"><!--here padding is used ON ""Y-axis""-->
      <div class="container">
        <div class="row">
        </div>
      </div>
    </header>
    <!-- HEADER END -->
<!-- MAIN area -->

  <section class="container py-2 mb-4">
    <div class="row">
      <div class="offset-sm-3 col-sm-6" style="min-height:650px;">
        <?php
        echo Errormsg();//php scope of the function
        echo Successmsg();
         ?>
        <div class="card bg-secondary text-light">
          <div class="card-header">
            <h4>WELCOME To Your FPO</h4>
            <hr>
            <h4>Login As Admin/BOD</h4>
            </div>
            <div class="card-body bg-dark">
            <form class="" action="login.php" method="post">
              <div class="form-group">
                <label for="username"><span class="FieldInfo text-light">Admin/BOD UserName :</span></label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text text-white bg-info"><i class="fas fa-user"></i></span>
                  </div>
                  <input type="text" class="form-control" name="Username" id="username" value="">
                </div>
              </div>
              <div class="form-group">
                <label for="password"><span class="FieldInfo text-light">Password :</span></label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text text-white bg-info"><i class="fas fa-lock"></i></span>
                  </div>
                  <input type="password" class="form-control" name="Password" id="password" value="">
                </div>
              </div>
              <input type="submit" name="Submit" class="btn btn-info btn-block" value="Login">
            </form>
            <br>
            <a href="forgetpassword1.php">Forget Password ?</a><br><br>
            <div class="card mt-3">
              <div class="card-head">
                <a href="memberslogin.php">LOGIN as a Member</a>

              </div>
            </div>

          </div>

        </div>

      </div>

    </div>
  </section>

<!-- MAIN area Ending -->





<?php require_once("footer.php");?>
