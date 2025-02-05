<!DOCTYPE html>
<html lang="en">
<?php
include("header.php");
$studid = $_SESSION['user_id'];
$queryResult = mysqli_query($con,"SELECT * FROM user_db WHERE user_id='".$studid."'") or die(mysqli_error());
$result = mysqli_fetch_array($queryResult);
?>
<body>

<?php
include("topbar.php");
?>

  <main id="main" class="main">



    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item"><a href="users.php">User</a></li>
          <li class="breadcrumb-item active">Manage User Information</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- start of Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-12">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <br>
                  <img src="../images/vectors/useruser.png" width="100%" alt="">
                </div>

              </div>
            </div><!-- End Sales Card -->


          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Update Image</h5>

            
            
              <!-- Custom Styled Validation -->
              <form class="row g-3 needs-validation" method="POST" enctype="multipart/form-data" novalidate>
               
                <div class="col-md-4">
                  <label for="validationCustom04" class="form-label">Image</label>
                  <input type="file" class="form-control" name="fileToUpload" id="fileToUpload" required>
                 
                </div>
                
                
                <div class="col-12">
                  <button class="btn btn-success" type="submit" name="btn_submit">Update Image</button>
                </div>
              </form><!-- End Custom Styled Validation -->

            </div>
          </div>

          </div>
        </div>

        <!-- End Left side columns -->

      </div>
    </section>

  </main><!-- End #main -->

  <?php 
  include("footer.php");
  ?>

</body>

</html>



<?php
$date = date("Y-m-d");
if(isset($_POST["btn_submit"])){
   $target_dir = "images/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $image_url = $_FILES["fileToUpload"]["name"];
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
    
    mysqli_query($con,"UPDATE admin_db SET image_url='$image_url' where id = '1'") or die(mysqli_error());
    echo "<script>alert('User Account has been updated successfully!'); window.location='users.php'</script>";
    
}else{

}
?>