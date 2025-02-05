<?php

include('dbcon.php');
session_start();
 if(isset($_POST['btn_login'])){
    $uname = $_POST['email'];
    $psw = md5($_POST['password']);

    $query = mysqli_query($con, "SELECT * FROM user_db WHERE email='".$uname."' and password='".$psw."' ");
    $row = mysqli_fetch_array($query);
    $numrow = mysqli_num_rows($query);
    if($numrow > 0){
           
        $_SESSION['email'] = $row['email'];
        $_SESSION['fname'] = $row['firstname'];
        $_SESSION['lname'] = $row['lastname'];
        $_SESSION['utype'] = $row['account_type'];
        $_SESSION['user_id'] = $row['user_id'];
        echo "<script>alert('successfully login. directing to homepage.'); window.location='user/index.php';</script>";

    }
    else{
        echo "<script>alert('Email or Password is incorrect.');  window.location='userlogin.php';</script>";
    }
}
?>