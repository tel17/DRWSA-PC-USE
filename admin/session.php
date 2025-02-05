<?php
    //start ng session
    session_start();

    if(!isset($_SESSION['fname']) || (trim($_SESSION['fname'] == ''))){
        echo "<script>alert('Please login first to continue!'); window.location='../index.php';</script>";
        exit();
    }
    else{
        $session_id = $_SESSION['account_id'];
    }
?>