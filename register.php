<?php
include "inc/functions.php";
$name=$email=$ph_no=$pass='';
if(isset($_GET['id'])){
    list($id, $name, $email, $ph_no,$remark,$profile_image,$pass) = register(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
}
?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css" />
<link rel="stylesheet" href="main.css">

<!------ Include the above in your HEAD tag ---------->
 
<div class="container register-form">
<form action="store.php" method="POST" enctype="multipart/form-data"> 
            <div class="form">
                <div class="note">
                    <p>Please Register your information here!</p>
                </div>

                <div class="form-content">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" placeholder="Enter your name here" title="Please enter your name" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
                            </div>
                            <div class="form-group">
                            <label for="pass">Password:</label>
                            <input type="pass" class="form-control" placeholder="Enter your pass here" title="Please enter your pass" name="pass" id="pass" value="<?php echo htmlspecialchars($pass); ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" placeholder="Enter your email here" title="Please enter your email" name="email" id="email" value="<?php echo htmlspecialchars($email); ?>" required>
                            </div>
                            <div class="form-group">
                            <label for="ph_no">Phone:</label>
                                <input type="tel" pattern="[0-9]{2}[0-9]{9}" class="form-control" placeholder="Enter your phone number here" title="Please enter your phone number" name="ph_no" id="ph_no" value="<?php echo htmlspecialchars($ph_no); ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label>Remark</label>
                            <textarea name="remark" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
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
                        </div>
                    </div>
                    <?php
                            if(!empty($id)){
                                echo '<input type="hidden" name="id" value="' . $id . '" />';
                            }

                            if(empty($id)){
                                echo '<div class="form-group row">';
                      
                                echo '<div class="col-md-1">';
                                echo' <a href="login.php" class="btn btn-success btn-sm" data-rel="back">Go Back</a> ';
                                echo '</div>';

                                echo '<div class="col-md-1">';
                                echo '<button type="submit" class="btn btn-primary btn-sm">Register Now</button>';
                                echo '</div>';
                                
                                echo '</div>';
                            
                            }
                    ?>
                </div>
            </div>
</div>
</form>
</div>
<script src="script.js"></script>

<style>
.note
{
    text-align: center;
    height: 80px;
    background: -webkit-linear-gradient(left, #0072ff, #8811c5);
    color: #fff;
    font-weight: bold;
    line-height: 80px;
}
.form-content
{
    padding: 5%;
    border: 1px solid #ced4da;
    margin-bottom: 2%;
}
.form-control{
    border-radius:1.5rem;
}
.btnSubmit
{
    border:none;
    border-radius:1.5rem;
    padding: 1%;
    width: 20%;
    cursor: pointer;
    background: #0062cc;
    color: #fff;
}
</style>

