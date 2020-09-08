<?php
session_start();
include('config.php');
$email=$_POST['email'];
$password=$_POST['password'];
$login="SELECT * FROM login WHERE email='$email' AND password='$password'";
$login_result=mysqli_query($con,$login) or die(mysqli_error($con));
header('Location:attendance.php');
$_SESSION['email']=$email;
?>