<!DOCTYPE html>
<html lang="en">

<?php
  include("header.php");
  include("dbcon.php");
?>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

             

              <div class="card mb-3">

                <div class="card-body">


                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Forgot your
                       <img src="images/logodwell.png"  width="7%" alt=""> DWELL Password?</h5>
                    <p class="text-center small">Enter Email to create new password</p>
                  </div>

                  <form class="row g-3 needs-validation"  method="POST" enctype="multipart/form-data" novalidate>

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Email</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="email" name="email" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Please enter a valid email!</div>
                      </div>
                    </div>

                  
                    <div class="col-12">
                      <input class="btn btn-primary w-100" type="submit" name="btn_forgot" value="Email my new password" />
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Already have an account? <a href="login.php">Login Here</a></p>
                    </div>
                  </form>

                </div>
              </div>

           

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>


<?php
 ini_set( 'display_errors', 1 );
   error_reporting( E_ALL );
   $from = "contactus@dwellclinic.online";
   $subject = "Changing of Password";
   
   if(isset($_POST['btn_forgot']))
    {
    $otp = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%&", 8)), 0, 12);
    $text_email=$_POST['email'];
    $to = $_POST['email'];
    $sqlb = "SELECT * FROM admin_db where email ='".$text_email."' " ;
    $ansb = $con->query($sqlb);
    $resb=mysqli_num_rows($ansb);
    
    if($resb > 0){
        $otp_pass = md5($otp);
        
        
        $sql = "UPDATE admin_db SET password ='$otp_pass' WHERE email='$text_email'" or die(mysqli_error());
        $ans1 = $con->query($sql);
        
        $message = "Good day Admin! Your trying to change your password\r\nYour new Password is :'".$otp."'\r\n";
        $message .= "Be careful on scams and hacking.\r\n\r\n";
        $message .= "Your Dwell Clinic Family\r\n";
        // The content-type header must be set when sending HTML email
           $headers = "MIME-Version: 1.0" . "\r\n";
           $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
           $headers = "From:" . $from;
           if(mail($to,$subject,$message, $headers)) {
              echo "<script>alert('Please check your email. Thank you!'); window.location='index.php'</script>"; 
           } else {
              echo "<script>alert('Connection to the email server failed. Please try again later'); window.location='index.php'</script>"; 
           }
    }else{
        
    $sqlb = "SELECT * FROM user_db where email ='".$text_email."' " ;
    $ansb = $con->query($sqlb);
    $resb=mysqli_num_rows($ansb);
    
    
      if($resb != 0){
        $otp_pass = md5($otp);
        
        
        $sql = "UPDATE user_db SET password ='$otp_pass' WHERE email='$text_email'" or die(mysqli_error());
        $ans1 = $con->query($sql);
        
        $message = "Good day! Your trying to change your password\r\nYour new Password is :'".$otp."'\r\n";
        $message .= "Be careful on scams and hacking.\r\n\r\n";
        $message .= "Your Dwell Clinic Family\r\n";
        // The content-type header must be set when sending HTML email
           $headers = "MIME-Version: 1.0" . "\r\n";
           $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
           $headers = "From:" . $from;
           if(mail($to,$subject,$message, $headers)) {
              echo "<script>alert('Please check your email. Thank you!'); window.location='index.php'</script>"; 
           } else {
              echo "<script>alert('Connection to the email server failed. Please try again later'); window.location='index.php'</script>"; 
           }
    }else{
        echo "<script>alert('Email is not registered in our system. Please try again.'); window.location='index.php'</script>"; 
    }
    }
    }
?>
