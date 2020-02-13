<?php 
    include 'inc/header.php';

?>

    <div class="row loginsection">
    
        <div class="col-md-4 offset-md-4">
        <div class="container">
            <div class="loginwrap">
                <h2 class="py-5 text-center" id="loginMenu">Account Login</h2>
                <form action="login.php" method="post">
                    <div class="form-group">
                        <!-- <label for="name">Name</label> -->
                        <input type="text" name="username" class="form-control" id="name" placeholder="Enter Name">
                    </div>
                    <div class="form-group">
                        <!-- <label for="password">Password</label> -->
                        <input type="password" name="password" class="form-control" id="password" placeholder="Enter Password">
                    </div>
                    <button type="submit" class="btn btn-primary btn-md btn-block">Login</button><br>
                    <a href="register.php">Register</a>
                </form>
            </div>
        </div>
        </div>
    </div>
   
   
<?php
    include 'inc/footer.php';
?>

