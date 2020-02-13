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
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        foreach (get_customer_list() as $item) {
                        ?>
                      <tr>
                        <td><?php echo $item['id']; ?></td>
                        <td><?php echo $item['name']; ?></td>
                        <td><?php echo $item['email']; ?></td>
                        <td><?php echo $item['ph_no']; ?></td>
                        <td><?php echo $item['remark']; ?></td>
                        
                        <td><?php echo '<a href="" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalRelatedContent" data-id="'. $item['id'] .'" data-image="'. $item['profile_image'] .'" data-name="'. $item['name'] .'" data-email="'.$item['email'].'" data-ph_no="'.$item['ph_no'].'" data-remark="'.$item['remark'].'">Info</a>'?></td>
                      
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
                            <?php 

                            echo "<td><a class='btn btn-primary btn-sm' href='customer.php?id=" . $item['id'] . "'>Edit</a>";
                            echo "</td>";
                            echo "<td><form method='post' action='customer_list.php' class='d-inline float-right' onsubmit=\"return confirm('Are you sure you want to delete this project?');\">";
                            echo "<input type='hidden' value='".$item['id'] ."' name='delete'>";
                            echo "<input type='submit' class='btn btn-danger btn-sm' value='Delete'>";
                            echo "</form>";
                            echo "</td>";
                            echo "</tr>";

                            ?>
                           
                    <?php
                          }
                    ?>
                              </tbody>
                          </table>
                      </div>
                      </div>
                  </div>
              </div>
              
            
</section>

<script type="text/javascript">
        
        // data-* attributes to scan when populating modal values
        var ATTRIBUTES = ['id', 'name','image','email','ph_no','remark'];
        
        
        $('[data-toggle="modal"]').on('click', function (e) {
            var $target = $(e.target);
            // modal targeted by the button
            var modalSelector = $target.data('target');
            
            // iterate over each possible data-* attribute
            ATTRIBUTES.forEach(function (attributeName) {
                var $modalAttribute = $(modalSelector + ' #modal-' + attributeName);
                
                var dataValue = $target.data(attributeName);
               
                if(attributeName == "image") {
                    
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



