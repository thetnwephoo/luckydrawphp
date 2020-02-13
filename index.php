<?php
session_start();
$auth = isset ($_SESSION['auth']);
include 'inc/header.php';
if($auth) { 
include 'inc/heroarea.php';
include 'inc/contact.php';
include 'inc/about.php';

 } else { 
    echo '<script type="text/javascript">window.location = "login-form.php"; </script>';
}
include 'inc/footer.php';
?>