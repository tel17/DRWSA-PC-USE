<?php
    session_start();
    session_destroy();
    echo "<script>alert('user successfully logout!'); window.location='../login.php'; </script>";
?>