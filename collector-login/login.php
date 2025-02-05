<?php
session_start(); // Start the session to access session variables
$error = isset($_SESSION['error']) ? $_SESSION['error'] : null;
$success = isset($_SESSION['success']) ? $_SESSION['success'] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login to Your Collector Account</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.12.0/toastify.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.12.0/toastify.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100vh;
        }
        .login-form {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            border: 1px solid #ced4da;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .login-form img {
            display: block;
            margin: 0 auto 15px;
            max-width: 80px;
            height: auto;
        }
        .login-form h2 {
            color: #007bff;
            margin-bottom: 20px;
            text-align: center;
        }
        .input-group {
            width: 100%;
        }
        .form-control {
            border-radius: 5px;
            min-width: 100%;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            padding: 10px;
            border-radius: 5px;
            font-weight: bold;
            width: 100%;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .text-center a {
            color: #007bff;
            text-decoration: none;
        }
        .text-center a:hover {
            text-decoration: underline;
        }
        .form-group {
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-form p-4 border rounded shadow-sm bg-white">
            <img src="NEW-LOGO.png" alt="logo">
            <h2>Login to Your Collector Account</h2>
            <form action="collector_verify_login.php" method="post">
                <div class="form-group">
                    <label for="username" class="form-label">Username</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary" name="btn_login">Login</button>
            </form>
        </div>
    </div>

    <!-- Display error toast if exists -->
    <?php if ($error): ?>
        <script>
            Toastify({
                text: "<?php echo $error; ?>",
                backgroundColor: "rgb(226, 68, 68)",
                duration: 3000,
                close: true
            }).showToast();
        </script>
        <?php unset($_SESSION['error']); // Clear error after displaying ?>
    <?php endif; ?>

    <!-- Display success toast if exists -->
    <?php if ($success): ?>
        <script>
            Toastify({
                text: "<?php echo $success; ?>",
                backgroundColor: "linear-gradient(to right, #28a745, #218838)", // Green for success
                duration: 3000,
                close: true
            }).showToast();
        </script>
        <?php unset($_SESSION['success']); // Clear success after displaying ?>
    <?php endif; ?>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>
</html>
