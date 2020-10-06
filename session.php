<?php
   include('db_connection.php');
   session_start();
   
   $user_check = $_SESSION['login_user'];
   $user_check = $_SESSION['reset_password'];
   
   $ses_sql = mysqli_query($db,"select username from admin where username = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['username'];
   $reset_password = $row['username'];
      
   if(!isset($_SESSION['login_user'])){
      header("location:form.php");
      die();
   }

   if(!isset($_SESSION['reset_password'])){
      header("location:reset.php");
      die();
   }
?>
