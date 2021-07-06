<?php require_once("includes/db.php");?>
<?php require_once("includes/functions.php");?>
<?php require_once("includes/sessions.php");?>
<?php require_once("header.php") ?>

<?php

  $_SESSION["trackingURL"]=$_SERVER["PHP_SELF"];
  // we equal the SERVER to the url and redirect to it
//  echo $_SESSION["trackingURL"];


  confirm_login();

  $adminid=$_SESSION["user_id"];
  // echo Errormsg();//php scope of the function
  // echo Successmsg();
  global $connectingdb;
  $sql="SELECT * FROM leader_bod WHERE id='$adminid'";
  $stmt=$connectingdb->query($sql);
  while ($DateRows = $stmt->fetch()) {
    $existingusername=$DateRows["username"];

  }


 ?>
    <!-- HEADER -->
    <header class="bg-dark text-white py-3"><!--here padding is used ON ""Y-axis""-->
      <div class="container">
        <div class="row">
          <div class="col-md-8" style="color:white;">
          <h2><i class="fas fa-cog fa-spin" style="color:yellow;"></i>
            Dashboard &nbsp; &nbsp; &nbsp;
          </h3>
        </div><div class="col-md-4" style="color:primary;">
          <h2><i class="fas fa-user" style="color:primary;">&nbsp;&nbsp;@<?php echo $existingusername; ?></i>
<hr style="border-top: 1px solid #ccc; background: transparent;">
          </h3>
          </div>
          <div class="col-lg-3 mb-2">
          <a href="addnewpost.php" class="btn btn-primary btn-block">
            <i class="fas fa-edit"></i> Add New Post
          </a>
        </div>
        <div class="col-lg-3 mb-2">
          <a href="categories.php" class="btn btn-info btn-block">
            <i class="fas fa-folder-plus"></i> Add New Category
          </a>
        </div>
        <div class="col-lg-3 mb-2">
          <a href="admins.php" class="btn btn-warning btn-block">
            <i class="fas fa-user-plus"></i> Add New Admin
          </a>
        </div>
        <div class="col-lg-3 mb-2">
          <a href="comments.php" class="btn btn-success btn-block">
            <i class="fas fa-check"></i> Approve Comments
          </a>
        </div>
        </div>
      </div>
    </header>
    <!-- HEADER END -->
<br>
    <!-- main area -->

    <section class="container py-2 mb-4">
      <div class="row" style="min-height:730px">

         <!-- Left side area -->
        <div class="col-lg-2 d-none d-md-block">
          <div class="card text-center bg-dark text-white mb-3">
            <div class="card-body">
              <h1 class="lead">Posts</h1>
              <h4 class="display-5">
                <i class="fab fa-readme"></i>
                <?php
                  totalposts();
                 ?>
              </h4>
            </div>
          </div>
          <div class="card text-center bg-dark text-white mb-3">
            <div class="card-body">
              <h1 class="lead">Categories</h1>
              <h4 class="display-5">
                <i class="fas fa-folder"></i>
                <?php
                  totalcategories();
                 ?>
              </h4>
            </div>
          </div>
          <div class="card text-center bg-dark text-white mb-3">
            <div class="card-body">
              <h1 class="lead">Admins</h1>
              <h4 class="display-5">
                <i class="fas fa-users"></i>
                <?php
                  totaladmins();
                ?>
              </h4>
            </div>
          </div>
          <div class="card text-center bg-dark text-white mb-3">
            <div class="card-body">
              <h1 class="lead">Members</h1>
              <h4 class="display-5">
                <i class="fas fa-users"></i>
                <?php
                  totalmembers();
                ?>
              </h4>
            </div>
          </div>
          <div class="card text-center bg-dark  text-white mb-3">
            <div class="card-body">
              <h1 class="lead">Comments</h1>
              <h4 class="display-5">
                <i class="fas fa-comments"></i>
                <?php
                  totalcomments();
                 ?>
              </h4>
            </div>
          </div>
          <div class="card text-center bg-dark  text-white mb-3">
            <div class="card-body">
              <h1 class="lead">Requests </h1>
              <h4 class="display-5">
                <i class="fas fa-info"></i>
                <?php
                  totalrequests();
                 ?>
              </h4>
            </div>
          </div>
        </div>
        <!-- left side area end -->
        <!-- RIGHT side area Starts -->
        <div class="col-lg-10">
          <h1>Top Posts</h1>
          <table class="table table-striped table-hover">
            <thead class="thead-dark">
              <tr>
                <th>Sr.no.</th>
                <th>title</th>
                <th>date/time</th>
                <th>author</th>
                <th>comments</th>
                <th>details</th>
              </tr>

            </thead>
            <?php
            $srno=0;
            global $connectingdb;
            $sql="SELECT * FROM posts ORDER BY id desc LIMIT 0,6";
            $stmt=$connectingdb->query($sql);
            while ($DataRows=$stmt->fetch()) {
              $postid=$DataRows["id"];
              $datetime=$DataRows["datetime"];
              $author=$DataRows["author"];
              $title=$DataRows["title"];
              $srno++;

             ?>

             <tbody>
                <tr>
                  <td><?php echo $srno; ?></td>
                  <td><?php echo $title; ?></td>
                  <td><?php echo $datetime; ?></td>
                  <td><?php echo $author ; ?></td>
                  <td>
                      <?php
                        $total1=approvecommentsofpost($postid);
                        if ($total1>0) {
                        ?>
                        <span class="badge badge-success">
                          <?php
                        echo $total1;?>
                      </span>
                      <?php } ?>


                      <?php
                      $total2=Disapprovecommentsofpost($postid);
                        if ($total2>0) {
                        ?>
                        <span class="badge badge-danger">
                          <?php
                        echo $total2;?>
                      </span>
                      <?php } ?>
                  </td>
                  <td>
                    <a target="_blank" href="fullpost.php?id=<?php echo $postid; ?>">
                    <span class="btn btn-info">Preview</span>
                    </a>
                  </td>
                </tr>
             </tbody>
<?php   } ?>
          </table>
        </div>
        <!-- Right side area Ends -->
      </div>
    </section>



    <!-- main area End -->


    <!-- FOOTER -->
    <?php require_once("footer.php") ?>
