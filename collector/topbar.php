<?php
// Check if the user is not logged in
if (!isset($_SESSION['collector_username'])) {
    $_SESSION['error'] = "Please log in first!";
    header("Location: login.php");
    exit();
}

// Store session data into variables
$collector_username = $_SESSION['collector_username'];
$success = isset($_SESSION['success']) ? $_SESSION['success'] : null;
?>
<style>
  .custom-margin-right {
    margin-right: 20px; /* Adjust the value as needed */
}
h5{
  margin-right: 20px;
}
</style>
<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center text-black">
    <div class="d-flex align-items-center justify-content-between">
      
        <a href="#" class="logo d-flex align-items-center text-black">
            <img src="./assets/img/NEW-LOGO.png" alt="">
            <span class="d-none d-lg-block">D</span>
            <span class="d-none d-lg-block">RWSA</span>
            <small>|</small>
            <small>&nbsp;Collector</small>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
        <h5 class="mr-1">Hello!</h5>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-black d-flex align-items-center custom-margin-right" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
  
    <span><?php echo htmlspecialchars($collector_username); ?></span>
</a>


                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                    <!-- <a class="dropdown-item" href="#"><i class="bi bi-person"></i> Profile</a> -->
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-danger" href="logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</header><!-- End Header -->
