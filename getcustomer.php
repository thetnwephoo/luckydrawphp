<?php
include 'inc/connection.php';
$customer_id = $_GET['customerNumber'];
// var_dump($customer_id);
$sql = 'SELECT id, name, email, ph_no,remark,profile_image FROM customers WHERE id = ?';

    try{
        $results = $conn->prepare($sql);
        $results->bindValue(1, $customer_id, PDO::PARAM_INT);
        $results->execute();
    }
    catch(Exception $e){
        echo "Error!:" . $e->getMessage() . "
";
        return false;
    }
    echo json_encode($results->fetchAll(PDO::FETCH_ASSOC));
?>