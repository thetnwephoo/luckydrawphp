<?php 
session_start();
$auth = isset($_SESSION['auth']);
if($auth) {
include "inc/header.php";
include "inc/functions.php";
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css" />
<link rel="stylesheet" href="main.css">

<?php

$name=$email=$ph_no=$pass='';
if(isset($_GET['id'])){
    list($id, $name, $email, $ph_no,$remark,$pass) = get_customer(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
    
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
  
    $id= filter_input(INPUT_POST,'id' , FILTER_SANITIZE_NUMBER_INT);
    $name = trim(filter_input(INPUT_POST,'name' , FILTER_SANITIZE_STRING));
    $email = trim(filter_input(INPUT_POST,'email' , FILTER_SANITIZE_STRING));
    $ph_no = trim(filter_input(INPUT_POST,'ph_no' , FILTER_SANITIZE_STRING));
    $remark = trim(filter_input(INPUT_POST,'remark' , FILTER_SANITIZE_STRING));
    $pass= trim(filter_input(INPUT_POST,'pass' , FILTER_SANITIZE_STRING));
    $profile_image = time() . '-' . $_FILES["profileImage"]["name"];
    $target_dir = "images/";
    $target_file = $target_dir . basename($profile_image);
    move_uploaded_file($_FILES["profileImage"]["tmp_name"], $target_file);
    if(add_customer($name, $email, $ph_no, $id,$profile_image,$remark,$pass)){
        echo "<script type='text/javascript'> window.location = 'customer_list.php'; </script>";
        exit;
    }else{
        $error_message = 'Could not add Customer';
            echo "<script type='text/javascript'>
                var result = confirm('Duplicate Error. Please Try again!'); 
                if (result == true) {
                        // window.location = 'customer.php';
                    } else {
                            window.location = 'customer_list.php';
                        }
                        </script>";
    }
}


?>
<div class="container hero-section"> 
<?php
if(!empty($id))
{
    echo '<h2 style="text-align: center;" class="custom-page">Edit Customer</h2>';
}else{
    echo '<h2 style="text-align: center;" class="custom-page">Register Here</h2>';
}

?>
<form action="customer.php" method="POST" enctype="multipart/form-data">   
<div class="form-group">
<label for="name">Name:</label>
<input type="text" class="form-control" placeholder="Enter your name here" title="Please enter your name" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
</div>
<div class="form-group">
<label for="email">Email:</label>
<input type="email" class="form-control" placeholder="Enter your email here" title="Please enter your email" name="email" id="email" value="<?php echo htmlspecialchars($email); ?>" required>
</div>
<div class="form-group">
<label for="ph_no">Phone Number:</label>
<input type="tel" pattern="[0-9]{2}[0-9]{9}" class="form-control" placeholder="Enter your phone number here" title="Please enter your phone number" name="ph_no" id="ph_no" value="<?php echo htmlspecialchars($ph_no); ?>" required>
</div>
<div class="form-group">
<div class="row">
      <div class="col-4">
       
          <div class="form-group text-center" style="position: relative;" >
            <span class="img-div">
              <div class="text-center img-placeholder"  onClick="triggerClick()">
                <h4>Update image</h4>
              </div>
              <img src="images/avatar.jpg" onClick="triggerClick()" id="profileDisplay">
            </span>
            <input type="file" name="profileImage" onChange="displayImage(this)" id="profileImage" class="form-control" style="display: none;">
            <label>Profile Image</label>
          </div>
          <div class="form-group">
            <label>Remark</label>
            <textarea name="remark" class="form-control"><?php echo htmlspecialchars($remark)?></textarea>
          </div>
      </div>
    </div>
</div>
<div class="form-group">
<label for="pass">Password:</label>
<input type="pass" class="form-control" placeholder="Enter your pass here" title="Please enter your pass" name="pass" id="pass" value="<?php echo htmlspecialchars($pass); ?>" required>
</div>

<?php
if(!empty($id)){
    echo '<input type="hidden" name="id" value="' . $id . '" />';
}

if(!empty($id)){
    
    echo '<div class="form-group row">';
            
    echo '<div class="col-md-1">';
    echo' <a href="customer_list.php" class="btn btn-success btn-sm" data-rel="back">Go Back</a> ';
    echo '</div>';

    echo '<div class="col-md-1">';
    echo '<button type="submit" class="btn btn-primary btn-sm">Update</button>';
    echo '</div>';

    echo '</div>';
}else{
    echo '<div class="form-group row">';
            
    echo '<div class="col-md-1">';
    echo' <a href="customer_list.php" class="btn btn-success btn-sm" data-rel="back">Go Back</a> ';
    echo '</div>';

    echo '<div class="col-md-1">';
    echo '<button type="submit" class="btn btn-primary btn-sm">Add</button>';
    echo '</div>';

    echo '</div>';
   
}
?>
</form>
</div>
<?php
}

else {
    header('location:login-form.php');
}
include "inc/footer.php";

?>
<script src="script.js"></script>
