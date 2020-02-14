<?php
session_start();
$auth = isset($_SESSION['auth']);
if($auth) {
    include "inc/header.php";
    include "inc/functions.php";
    
    if(isset($_POST['delete'])){
        if(delete_customer(filter_input(INPUT_POST, 'delete', FILTER_SANITIZE_NUMBER_INT))){
            echo "<script type='text/javascript'> window.location = 'customer_list.php'; </script>";
            exit;
        }else{
            echo "<script type='text/javascript'> window.location = 'customer_list.php'; </script>";
            exit;
        }
    }
    
    ?>
    <link rel="stylesheet" href="main.css">
    
    
    <section class="main_section">
    <div class="container hero-section">
    <div class="row">
    <div class="col-md-12 text-center">
    <?php
    if(isset($error_message)){
        echo "<p class='alert alert-danger mt-3'>$error_message</p>";
    }
    ?>
    <h3 class="add-project mt-custom">Customer List</h3>
    <a href="customer.php" class="action_link">
    <div class="action_icon">
    <img src="img/users-256.png" alt="project list icon" class="img-fluid img-margin">
    Add Customer
    </div>
    </a>
    <div class="table-responsive">
    <table class="table table-striped" id="myTable">
    <thead>
    <tr>
    <th scope="col">ID</th>
    <th scope="col">Name</th>
    <th scope="col">Email</th>
    <th scope="col">ph_no</th>
    <!-- <th scope="col">Remark</th> -->
    
    <th scope="col" style = "width:300px">Action</th>
    <!-- <th scope="col" colspan="3">Action</th> -->
    </tr>
    
    </thead>
    <tbody>
    
    </tbody>
    </table>
    </div>
    </div>
    </div>
    </div>
    
    <!-- Modal Box -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">User Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

    
    </section>
    
    <script type="text/javascript">
    $(document).ready(function() {
        $(document).on('click', '.info', function(){
            var id = $(this).attr("id");
            // $(".info").attr("data-target", "#staticBackdrop");
            // $(".modal-body").html(id);
            $.ajax({
                url:"show.php",
                method:"POST",
                data:{employee_id:id},
                success:function(data){
                    $('.modal-body').html(data);
                    $('.info').attr("data-target", "#staticBackdrop");
                },
                error:function(){
                    alert("error");
                }
            });
        });
    });
    </script>
    
    <?php
}
else {
    header('location:login-form.php');
}
include "inc/footer.php";
?>


<!-- <input type="text" name="employee_id" vlue="id"> -->
