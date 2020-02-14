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
                        <th scope="col">Remark</th>
                        
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
              <div class="modal fade right" id="modalRelatedContent" tabindex="-1" role="dialog"
                              aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false">
                              <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-info" role="document">
                                <!--Content-->
                                <div class="modal-content">
                                  <!--Header-->
                                  <div class="modal-header">
                                    <p class="heading">User Infromation</p>
                            
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true" class="white-text">&times;</span>
                                    </button>
                                  </div>
                            
                                  <!--Body-->
                                  <div class="modal-body">
                              
                                  <div class="row">
                                      <div class="col-5">
                                            <span id="modal-image"></span>
                                            
                                      </div>
                                    
                              
                                     <div class="col-7 text-left mybreak">
                                        <p><b>ID:</b><span id="modal-name"></span></p>
                                        <p><b>Name:</b><span id="modal-name"></span></p>
                                        <p><b>Email:</b><span id="modal-email"></span></p>
                                        <p><b>Phone:</b><span id="modal-ph_no"></span></p>
                                        <p><b>Remark:</b><span id="modal-remark"></span></p>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <!--/.Content-->
                              </div>

                          
                            </div>
            
</section>

<script type="text/javascript">
        
        // data-* attributes to scan when populating modal values
        var ATTRIBUTES = ['id', 'name','Image','email','ph_no','remark'];
        
        console.log("Hi");
        $(document).on('click', '.info',function (e) {
		
            var $target = $(e.target);
            // modal targeted by the button
            var modalSelector = $target.data('target');
            console.log(modalSelector);
            
            // iterate over each possible data-* attribute
            ATTRIBUTES.forEach(function (attributeName) {
                
                var $modalAttribute = $(modalSelector + ' #modal-' + attributeName);
                
                var dataValue = $target.data(attributeName);
                console.log($target.data('name'));
                console.log(dataValue);
                if(attributeName == "Image") {
                    
                    if(dataValue == null) {
                        var myimage = './images/noimage.png';
                    }
                    var myimage = './images/'+dataValue;
                    
                    document.getElementById("modal-image").innerHTML = '<img src="'+myimage+'" class="mark">';
                } else {
                    $modalAttribute.text(dataValue || '');
                }
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



