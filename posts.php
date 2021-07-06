<?php require_once("includes/functions.php");?>
<?php require_once("includes/db.php");?>
<?php require_once("header.php") ?>
<?php require_once("includes/sessions.php"); ?>
<!-- =============================================================================================== -->
<?php

  $_SESSION["trackingURL"]=$_SERVER["PHP_SELF"];
  // we equal the SERVER to the url and redirect to it
//  echo $_SESSION["trackingURL"];


  confirm_login();

 ?>
<!-- ====================login confirmation function================ -->

<header class="bg-dark text-white py-3"><!--here padding is used ON ""Y-axis""-->
      <div class="container">
        <div class="row">
          <div class="col-md-12">
          <h3><i class="fas fa-post" style="color:yellow;"></i> Manage Posts </h3><br>
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
<!-- ============================================================================================================ -->
<section class="w3-container py-2 mb-4">
      <div class="row">
        <div class="offset-lg-1 col-lg-8">
          <?php
          echo Errormsg();//php scope of the function
          echo Successmsg();
           ?>
          <table class="table table-striped table-hover">
          <thead class="thead-dark">
            <tr>
              <th>Sr.no</th>
              <th>Title</th>
              <th>Category</th>
              <th>Date&Time</th>
              <th>Author</th>
              <th>Banner1</th>
              <th>Banner2</th>
              <th>Comments</th>
              <th>Action</th>
              <th>Live Preview</th>
            </tr>
          </thead>
              <!-- showing POSTS by calling the table data of posts Table from database with the scope below -->
              <?php
              global $connectingdb;
              $sql="SELECT * FROM posts";
              $stmt=$connectingdb->query($sql);
              $sr=0;
              //it will be the serial no sataring from 1 in our table when while loop starts and will increment 1 by 1
              while ($DataRows=$stmt->fetch()) {
                      $Id= $DataRows["id"];
                      $DateTime  = $DataRows["datetime"];
                      $PostTitle = $DataRows["title"];
                      $Category  = $DataRows["category"];
                      $Admin     = $DataRows["author"];
                      $Image1     = $DataRows["image1"];
                      $Image2     = $DataRows["image2"];
                      $PostText  = $DataRows["post"];
                      $sr++;


               ?>
               <tbody>
                 <!-- if my post title > 20 so apply strlen function() on this posttitle
                 {} then make this posttitle to show limited character from 0 - 15 th character -->
                 <tr>
                   <td><?php echo $sr; ?></td>

                   <td>
              <?php
                  if(strlen($PostTitle)>20){$PostTitle= substr($PostTitle,0,18).'..';}
                   echo $PostTitle;
               ?>
           </td>
           <td>
              <?php
                  if(strlen($Category)>8){$Category= substr($Category,0,8).'..';}
                   echo $Category ;
               ?>
           </td>
           <td>
              <?php
                  if(strlen($DateTime)>11){$DateTime= substr($DateTime,0,11).'..';}
                     echo $DateTime ;
              ?>
          </td>
          <td>
              <?php
                  if(strlen($Admin)>8){$Admin= substr($Admin,0,8).'..';}
                     echo $Admin ;
               ?>
          </td>

          <td><img src="upload/<?php echo $Image1; ?>" width="170px;" height="100px"></img></td>

          <td><img src="upload/<?php echo $Image2; ?>" width="170px;" height="100px"></img></td>
                   <!-- ======================this will be the comments section============================  -->
                   <td>

                   </td>
                   <!-- =====================================comment ends================================================= -->
                   <td  style="min-width:200px;">
                     <a href="editnewpost.php?id=<?php echo $Id; ?>"><span class="btn btn-warning">Edit</span></a>
                     <a href="deletepost.php?id=<?php echo $Id; ?>"><span class="btn btn-danger">Delete</span></a>
                   </td>
                   <td style="min-width:140px;"><a href="fullpost.php?id=<?php echo $Id; ?>" target="_blank"><span class="btn btn-primary">Live Preview</span></a></td>
                 </tr>
               </tbody>
          <?php } ?>
<!-- //this is the ending of while loop to fetch all data from db table -->
          </table>
        </div>
      </div>
    </section>


<!-- ============================================================================================== -->
<br>
<?php require_once("footer.php"); ?>
