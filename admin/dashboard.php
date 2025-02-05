<!DOCTYPE html>
<html lang="en">
<?php include("header.php"); ?>
<body>

<?php include("topbar.php"); ?>
<?php include("sidebar.php"); ?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        <li class="breadcrumb-item active">Dashboard Data</li>
      </ol>
    </nav>
  </div>
  <!-- End Page Title -->

  <div class="container">
    <div class="card-container">
      <!-- Card 1 -->
      <div class="card">
        <div class="card-header">
          <h5>Total Number of Members</h5>
        </div>
        <div class="card-body">
          <p>Data goes here...</p>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="card">
        <div class="card-header">
          <h5>Total Number of Collectors</h5>
        </div>
        <div class="card-body">
          <p>Data goes here...</p>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="card">
        <div class="card-header">
          <h5>Another Statistic</h5>
        </div>
        <div class="card-body">
          <p>Data goes here...</p>
        </div>
      </div>
    </div>
  </div>

</main>

<?php include("footer.php"); ?>

<!-- Custom CSS -->
<style>
  .card-container {
    display: flex;
    justify-content: space-between; /* Distributes space evenly */
    flex-wrap: wrap; /* Ensures responsiveness */
  }

  .card {
    width: 30%; /* Keeps your original width */
    height: 30%;
    margin-top: 20px;
  }
</style>

</body>
</html>
