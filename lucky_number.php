<?php 
session_start();
$auth = isset($_SESSION['auth']);
if($auth) {
include "inc/header.php";
include "inc/functions.php";
?>
<?php
$lucky_number=$customer_name='';
if(isset($_GET['id'])){
   list($id, $lucky_number, $customer_name, $customer_id) = get_lucky_number(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
}
    
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id= filter_input(INPUT_POST,'id' , FILTER_SANITIZE_NUMBER_INT);
    $lucky_number = trim(filter_input(INPUT_POST,'lucky_number' , FILTER_SANITIZE_NUMBER_INT));
    $customer_id = trim(filter_input(INPUT_POST,'customer_id' , FILTER_SANITIZE_NUMBER_INT));
    
    if(add_luckynumber($lucky_number,$customer_id, $id)){
        echo "<script type='text/javascript'> window.location = 'luckynumber_list.php'; </script>";
        echo "success";
        exit;
    }else{
        $error_message = 'Could not add project';
        echo "<script type='text/javascript'> 
         var luckerror = confirm('Lucky Numbers Duplicate Error. Please Try again!'); 
         if(luckerror == true) {
            // window.location = 'lucky_number.php';
         } else {
           window.location = 'luckynumber_list.php';
         }
         </script>";


        // echo '<script type="text/javascript">
        //     swal({
        //         title: "Warnning!",
        //         text: "Lucky Numbers Duplicate Error. Please Try again!",
        //         icon: "warning",
        //         buttons: true,
        //         dangerMode: true,
        //     })
        //     .then((willDelete) => {
        //         if (willDelete) {
        //             window.location = "lucky_number.php";

        //         } else {
        //             window.location = "luckynumber_list.php";
        //         }
        //     });
          
        //   </script>';

        
    }
}

?>
<div class="container hero-section">
    <form action="lucky_number.php" method="POST">
    <div class="form-group">
        <label for="lucky_number" class="custom-page">Lucky Number:</label>
        <input type="text" pattern="\d*" min="0000" max="9999" minlength="4" step="4" maxlength="4" size="4" class="form-control" placeholder="Enter your lucky number here" title="Please enter your lucky number" id="lucky_number" name="lucky_number" value="<?php echo htmlspecialchars($lucky_number); ?>" required>
    </div>
    <div class="form-group">
    <label for="customers_id">Customers:</label>
     <?php
       // var_dump($id);
        //exit;
    ?> 
      <select class="form-control" id="customer_id" name="customer_id" 
     title="Please select the customer name" required>
        <option value="">Select the customer name here</option>
        <?php 
        // get_customer_list();
        foreach (get_customer_list() as $customers) {

            if(!empty($id)){
                echo "<option value='".$customers['id']. "'";
            if ($customer_id == htmlspecialchars($customers['id']) ) {
                echo " selected";
            }
            echo ">" . htmlspecialchars($customers['name']). "</option>";
            }else{
                echo "<option value='".htmlspecialchars($customers['id'])."'>".htmlspecialchars($customers['name'])."</option>";
            }
        }
    ?>
      </select>
    </div>
    <?php
        if(!empty($id)){
            echo '<input type="hidden" name="id" value="' . $id . '" />';
        }
    
    if(!empty($id)){
        echo '<button type="submit" class="btn btn-primary button-margin">Update</button>';
    }else{
        echo '<button type="submit" class="btn btn-primary button-margin">Add</button>';
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