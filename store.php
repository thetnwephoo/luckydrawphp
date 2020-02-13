<?php
include "inc/functions.php";
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id= filter_input(INPUT_POST,'id' , FILTER_SANITIZE_NUMBER_INT);
    $name = trim(filter_input(INPUT_POST,'name' , FILTER_SANITIZE_STRING));
    $email = trim(filter_input(INPUT_POST,'email' , FILTER_SANITIZE_STRING));
    $ph_no = trim(filter_input(INPUT_POST,'ph_no' , FILTER_SANITIZE_STRING));
    $remark = trim(filter_input(INPUT_POST,'remark' , FILTER_SANITIZE_STRING));
    $pass = trim(filter_input(INPUT_POST,'pass' , FILTER_SANITIZE_STRING));
    
    $profile_image = time() . '-' . $_FILES["profileImage"]["name"];
    $target_dir = "images/";
    $target_file = $target_dir . basename($profile_image);
    move_uploaded_file($_FILES["profileImage"]["tmp_name"], $target_file);
    if(register($name, $email, $ph_no, $id,$profile_image,$remark,$pass)){
        echo "<script type='text/javascript'> window.location = 'index.php'; </script>";
        // exit;
    }else{
        $error_message = 'Could not add Customer';
    //   exit;
        echo "<script type='text/javascript'> 
         var error = confirm('Email Duplicate Error. Please Try again!'); 
         if(error == true) {
            window.location = 'register.php';
         } else {
           window.location = 'register.php';
         }
         </script>";
    }
}
?>