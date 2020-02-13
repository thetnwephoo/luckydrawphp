<?php
// session_start();
$auth = isset ($_SESSION['auth']);
?>

<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>LuckyDraw System</title>
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i&display=swap" rel="stylesheet">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/font-awesome.min.css"/>
	<link rel="stylesheet" href="css/owl.carousel.min.css"/>
	<link rel="stylesheet" href="css/slicknav.min.css"/>

	<!-- Main Stylesheets -->
  <link rel="stylesheet" href="css/style.css"/>
  <link rel="stylesheet" href="css/responsive.css"/>



	
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <!-- <script src="../js/app.js"></script> -->
  	
  

</head>
<body>
	<!-- Page Preloder -->
	<!-- <div id="preloder">
		<div class="loader"></div>
	</div> -->

	<!-- Header section -->
	<header class="header-section clearfix">
		<a href="index.php" class="site-logo">
			<h2><span class="lk">Lucky Draw</span> <span class="sy">System</span></h2> 
		</a>
		<ul class="main-menu">
			<?php if($auth) { ?>
			<li><a href="index.php">Home</a></li>
			<li><a href="customer_list.php">Customers</a></li>
			<li><a href="prize_list.php">Prize</a></li>
			<li><a href="luckynumber_list.php">Lucky Numbers</a></li>
			<li><a href="customer_prize.php">Winning Numbers</a></li>
			<li><a href="all_customer_prizes.php">All Winner</a></li>
			<li><a href="logout.php">Logout</a></li>
			<?php
 				} else { ?>
			  <li><a href="login-form.php">Login</a></li>
			  <?php }  ?>
		</ul>
	</header>
	<!-- Header section end -->