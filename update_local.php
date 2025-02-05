<!doctype html>
<html lang="en">
    <head>
        <?php
        include("dbcon.php");
        include("admin/session.php");
        ?>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="TemplateMo">

 <!-- Favicons -->
  <link href="images/logodwell.png" rel="icon">
  <link href="images/logodwell.png" rel="apple-touch-icon">
        <title>D-Well System</title>

        <!-- CSS FILES -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">

        <link href="css/bootstrap.min.css" rel="stylesheet">

        <link href="css/bootstrap-icons.css" rel="stylesheet">

        <link href="css/magnific-popup.css" rel="stylesheet">

        <link href="css/templatemo-first-portfolio-style.css" rel="stylesheet">
        

    </head>
    
    <body>

        <section class="preloader">
            <div class="spinner">
                <span class="spinner-rotate"></span>    
            </div>
        </section>

        <nav class="navbar navbar-expand-lg">
            <div class="container">

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <a href="index.html" class="navbar-brand mx-auto mx-lg-0"> D<img src="images/logodwell.png" width="10%"  alt="">ELL</a>
                <div class="d-flex align-items-center d-lg-none">
                 
                </div>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-lg-5">
                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="#section_1">Home</a>
                        </li>

                      
                    </ul>

                    <div class="d-lg-flex align-items-center d-none ms-auto">
                    
                    </div>
                </div>

            </div>
        </nav>

        <main>

            <section class="hero d-flex justify-content-center align-items-center" id="section_1">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5 col-12 position-relative">
                            <div class="hero-text">
                            </div>
                        </div>

                        <div class="col-lg-7 col-12">
                            <div class="hero-text">
                                <?php
                                    $queryz = mysqli_query($con,"SELECT * FROM update_local where id=1") or die(mysqli_error());
                                    $rows = mysqli_fetch_array($queryz);
                                ?>
                            <form  method="POST" class="custom-form contact-form" role="form" enctype="multipart-form">
                                <div class="hero-title-wrap d-flex align-items-center mb-4">
                                    <h1 class="hero-title ms-3 mb-0"><input type="text" name="welcome" id="name" class="form-control" value="<?php echo $rows['message']; ?>" ></h1>
                                </div>
                                <div class="col-lg-3 col-12 ms-auto">
                                    <button type="submit" name="update" class="form-control">update</button>
                                </div>
                            </form>
<?php
if(isset($_POST['update']))
    {
        $welcome = $_POST["welcome"];
        mysqli_query($con,"UPDATE update_local SET message='$welcome' where id=1") or die(mysqli_error());
    echo "<script>alert('Info updated successfully!'); window.location='update_local.php'</script>";
    }
?>
                                <p class="mb-4"><a class="custom-btn btn custom-link" href="admin/index.php">Back to Admin Page</a></p>
                            </div>
                        </div>

                      

                    </div>
                </div>

                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#535da1" fill-opacity="1" d="M0,160L24,160C48,160,96,160,144,138.7C192,117,240,75,288,64C336,53,384,75,432,106.7C480,139,528,181,576,208C624,235,672,245,720,240C768,235,816,213,864,186.7C912,160,960,128,1008,133.3C1056,139,1104,181,1152,202.7C1200,224,1248,224,1296,197.3C1344,171,1392,117,1416,90.7L1440,64L1440,0L1416,0C1392,0,1344,0,1296,0C1248,0,1200,0,1152,0C1104,0,1056,0,1008,0C960,0,912,0,864,0C816,0,768,0,720,0C672,0,624,0,576,0C528,0,480,0,432,0C384,0,336,0,288,0C240,0,192,0,144,0C96,0,48,0,24,0L0,0Z"></path></svg>
            </section>


            <section class="about section-padding" id="section_2">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-6 col-12">
                            <img src="images/vectors/Multinational.jpg" class="about-image img-fluid" alt="">
                        </div>

                        <div class="col-lg-6 col-12 mt-5 mt-lg-0">
                            <div class="about-thumb">

                                <div class="section-title-wrap d-flex justify-content-end align-items-center mb-4">
                                    <h2 class="text-white me-4 mb-0">About DWell </h2>
                                    
                                    
                                </div>
 <?php
                                    $queryz = mysqli_query($con,"SELECT * FROM update_local where id=2") or die(mysqli_error());
                                    $rows = mysqli_fetch_array($queryz);
                                ?>
                            <form  method="POST" class="custom-form contact-form" role="form" enctype="multipart-form">
                                    <h3 class="pt-2 mb-3"><input type="text" name="welcome" id="name" class="form-control" value="<?php echo $rows['message']; ?>" ></h3>
                                     <div class="col-lg-3 col-12 ms-auto">
                                    <button type="submit" name="update2" class="form-control">update</button>
                                </div>
                            </form>
<?php
if(isset($_POST['update2']))
    {
        $welcome = $_POST["welcome"];
        mysqli_query($con,"UPDATE update_local SET message='$welcome' where id=2") or die(mysqli_error());
    echo "<script>alert('Info updated successfully!'); window.location='update_local.php'</script>";
    }
?>

<?php
                                    $queryz = mysqli_query($con,"SELECT * FROM update_local where id=3") or die(mysqli_error());
                                    $rows = mysqli_fetch_array($queryz);
                                ?>
                            <form  method="POST" class="custom-form contact-form" role="form" enctype="multipart-form">
                                <p>  <textarea class="form-control" id="message" name="welcome" ><?php echo $rows['message']; ?></textarea></p>
                            <div class="col-lg-3 col-12 ms-auto">
                                    <button type="submit" name="update3" class="form-control">update</button>
                                </div>
                            </form>
<?php
if(isset($_POST['update3']))
    {
        $welcome = $_POST["welcome"];
        mysqli_query($con,"UPDATE update_local SET message='$welcome' where id=3") or die(mysqli_error());
    echo "<script>alert('Info updated successfully!'); window.location='update_local.php'</script>";
    }
?>
                            
                            
                            <?php
                                    $queryz = mysqli_query($con,"SELECT * FROM update_local where id=4") or die(mysqli_error());
                                    $rows = mysqli_fetch_array($queryz);
                                ?>
                            <form  method="POST" class="custom-form contact-form" role="form" enctype="multipart-form">
                                <p>  <textarea class="form-control" id="message" name="welcome" ><?php echo $rows['message']; ?></textarea></p>
                            <div class="col-lg-3 col-12 ms-auto">
                                    <button type="submit" name="update3" class="form-control">update</button>
                                </div>
                            </form>
<?php
if(isset($_POST['update4']))
    {
        $welcome = $_POST["welcome"];
        mysqli_query($con,"UPDATE update_local SET message='$welcome' where id=4") or die(mysqli_error());
    echo "<script>alert('Info updated successfully!'); window.location='update_local.php'</script>";
    }
?>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

       


          

           

        </main>

        <footer class="site-footer">
            <div class="container">
                <div class="row">

                    <div class="col-lg-12 col-12">
                        <div class="copyright-text-wrap">
                            <p class="mb-0">
                                <span class="copyright-text">Copyright © 2024 | DWELL. All rights reserved.</span>
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </footer>

        <!-- JAVASCRIPT FILES -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.sticky.js"></script>
        <script src="js/click-scroll.js"></script>
        <script src="js/jquery.magnific-popup.min.js"></script>
        <script src="js/magnific-popup-options.js"></script>
        <script src="js/custom.js"></script>

    </body>
</html>