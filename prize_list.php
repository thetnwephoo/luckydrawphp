<?php
session_start();
$auth = isset($_SESSION['auth']);
if($auth) {
include "inc/header.php";
include "inc/functions.php";
if(isset($_POST['delete'])){
    if(delete_prize(filter_input(INPUT_POST, 'delete', FILTER_SANITIZE_NUMBER_INT))){
        echo "<script type='text/javascript'> window.location = 'prize_list.php'; </script>";
        exit;
    }else{
        echo "<script type='text/javascript'> window.location = 'prize_list.php'; </script>";
        exit;
    }
}
?>
<section class="main_section">
    <div class="container">
        <div class="row hero-section">
            <div class="col-md-12 text-center fix">
                <?php
                    if(isset($error_message)){
                        echo "<p class='alert alert-danger mt-3'>$error_message</p>";
                    }
                ?>
                <h3 class="add-project mb-4">Prize List</h3>
                <a href="prize.php" class="action_link">
                    <div class="action_icon">
                    <img src="img/iconfinder_goals_47047.png" alt="project list icon" class="img-fluid mb-2">
                       Add Prize
                    </div>
                </a>
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th scope="col">Prize Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        foreach (get_prize_list() as $item) {
                            echo "<tr>";
                            echo "<td>". $item['prize_type']. "</td>";
                            echo "<td><a class='btn btn-primary btn-sm' href='prize.php?id=" . $item['id'] . "'>Edit</a>";
                            echo "<form method='post' action='prize_list.php' class='d-inline float-right' onsubmit=\"return confirm('Are you sure you want to delete this Prize?');\">";
                            echo "<input type='hidden' value='".$item['id'] ."' name='delete'>";
                            echo "<input type='submit' class='btn btn-danger btn-sm' value='Delete'>";
                            echo "</form>";
                            echo "</td>";
                            echo "<tr>";
                        }
                    ?>
                    </tbody>
    </table>
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