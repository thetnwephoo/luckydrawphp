<?php  
include 'inc/connection.php';
if(isset($_POST["employee_id"]))
{
    $id = $_POST["employee_id"];
    $sql = 'SELECT * FROM customers WHERE id = ?';

    try{
        $results = $conn->prepare($sql);
        $results->bindValue(1, $id, PDO::PARAM_INT);
        $results->execute();
    }
    catch(Exception $e){
        echo "Error!:" . $e->getMessage() . "";
        return false;
    }
    $customer = $results->fetch();



    $output = '';
    // $output .= '<p>Name: ' . $customer['name'] .'</p>';
    // $output .= '<p>Email: ' .$customer['email'].'</p>';
    // $output .= '<p>Phone: '. $customer['ph_no'].'</p>';
    // $output .= '<div class="row">';
    // $output .= '<div class="col-md-6">';
    // $output .= '<img src="images/'. $customer['profile_image'] .' " >';
    // $output .='</div>'; 
    // $output .='<div class="col-md-6">';
    // $output .= '<p>Remark: '. $customer['remark'].'</p>';
    // $output .= '</div>';
    // $output.= '</div>';
    
    
    $output .= '<div class="row">'.' <div class="col-md-6">'. '<img src="images/' .$customer['profile_image'].'">'.'</div> '.'<div class="col-md-6">' .'<p> Remark:' . $customer['remark'].'</p>'. '</div>'.' </div>';
    
    echo $output;
}
?>
