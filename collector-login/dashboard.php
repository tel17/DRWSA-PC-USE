<?php
session_name("collector_session"); // Ensure collectors have a unique session
session_start();

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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collector Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.12.0/toastify.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.12.0/toastify.min.css">
</head>
<body>

    <div class="container mt-5">
        <h1 class="text-center">Collector Dashboard</h1>

        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Total Collections</div>
                    <div class="card-body">
                        <h5 class="card-title">₱ 0.00</h5>
                        <p class="card-text">Total amount collected today.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">Pending Collections</div>
                    <div class="card-body">
                        <h5 class="card-title">0</h5>
                        <p class="card-text">Number of pending collections.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-danger mb-3">
                    <div class="card-header">Failed Collections</div>
                    <div class="card-body">
                        <h5 class="card-title">0</h5>
                        <p class="card-text">Number of failed collections.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <h2>Welcome, <?php echo htmlspecialchars($collector_username); ?>!</h2>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>

    <!-- TOAST NOTIFICATION -->
    <?php if ($success): ?>
        <script>
            Toastify({
                text: "<?php echo htmlspecialchars($success); ?>", 
                backgroundColor: "#6ab07b",
                duration: 3000,
                close: false
            }).showToast();
        </script>
        <?php unset($_SESSION['success']); // Clear success message after displaying ?>
    <?php endif; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
