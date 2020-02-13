<?php
session_start();
$auth = isset($_SESSION['auth']);
if($auth) {
include "inc/header.php";
include "inc/functions.php";
if(isset($_POST['delete'])){
    if(delete_all_customer_prizes()){
        echo "<script type='text/javascript'> window.location = 'all_customer_prizes.php'; </script>";
        exit;
    }else{
        echo "<script type='text/javascript'> window.location = 'all_customer_prizes.php'; </script>";
        exit;
    }
}
?>
<section class="main_section">
    <div class="container">
        <div class="row hero-section">
            <div class="col-md-12 text-center all-prizes">
                <?php
                    if(isset($error_message)){
                        echo "<p class='alert alert-danger mt-3'>$error_message</p>";
                    }
                ?>
                <h3 class="add-project mb-4">All Customer Prize List</h3>
                
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th scope="col">Prize</th>
                        <th scope="col">Lucky Number</th>
                        <th scope="col">Customer Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        foreach (get_customer_prize_list() as $item) {
                            echo "<tr>";
                            echo "<td>". $item['prize_type']. "</td>"; 
                            echo "<td>". $item['lucky_number']. "</td>";
                            echo "<td>". $item['name']. "</td>";
                            echo "</tr>";
                        }
                    ?>
                    </tbody>
    </table>
    <?php
        echo "<form method='post' action='all_customer_prizes.php' class='d-inline float-right' onsubmit=\"return confirm('Are you sure you want to delete this project?');\">";
        echo "<input type='hidden' name='delete'>";
        echo "<input type='submit' class='btn btn-danger btn-sm delete' value='Reset All'>";
        echo "</form>";
    ?>
            </div>
        </div>
    </div>
</section>
<?php
}

else {
    header('location:login-form.php');
}
include "inc/footer.php";
?>