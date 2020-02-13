<?php
	session_start();
	include('inc/functions.php');
	$username= $_POST['username'];
	$password= $_POST['password'];
  
	// if ($username == "myo" && $password== "123") {
	// 	$_SESSION['auth'] = true;
	// }
	$user_data = user_login($username,$password);
	 
	if($user_data != false) {
		$_SESSION['auth'] = true;
		 echo "<script type='text/javascript'> window.location = 'index.php'; </script>";
        exit;
	}else {
		//header("location:login-form.php");
		echo "<script type='text/javascript'> window.location = 'login-form.php'; </script>";
	}
	?>