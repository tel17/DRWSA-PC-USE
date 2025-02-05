<?php

include('dbcon.php');
session_start();
 if(isset($_POST['btn_login'])){
    $uname = $_POST['email'];
    $psw = md5($_POST['password']);

    $query = mysqli_query($con, "SELECT * FROM admin_db WHERE email='".$uname."' and password='".$psw."' ");
    $row = mysqli_fetch_array($query);
    $numrow = mysqli_num_rows($query);


    $querys = mysqli_query($con, "SELECT * FROM user_db WHERE email='".$uname."' and password='".$psw."' ");
    $rows = mysqli_fetch_array($querys);
    $numrows = mysqli_num_rows($querys);

    if($numrow > 0){
           
        $_SESSION['email'] = $row['email'];
        $_SESSION['fname'] = $row['firstname'];
        $_SESSION['lname'] = $row['lastname'];
        $_SESSION['utype'] = $row['account_type'];
        $_SESSION['account_id'] = $row['account_id'];
        echo "<script>alert('successfully login. directing to homepage.'); window.location='admin/index.php';</script>";
         
    }
    else if($numrows > 0){

        $_SESSION['email'] = $rows['email'];
        $_SESSION['fname'] = $rows['firstname'];
        $_SESSION['lname'] = $rows['lastname'];
        $_SESSION['utype'] = $rows['account_type'];
        $_SESSION['user_id'] = $rows['user_id'];
        echo "<script>alert('successfully login. directing to homepage.'); window.location='user/index.php';</script>";

    }else{
        echo "<script>alert('Email or Password is incorrect.');  window.location='login.php';</script>";
    }
}
?>