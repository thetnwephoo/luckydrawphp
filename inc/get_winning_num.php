<?php
//Get Winning number
header('Content-Type: application/json');

$aResult = array();

if( !isset($_GET['functionname']) ) { $aResult['error'] = 'No function name!'; }

if( !isset($_GET['arguments']) ) { $aResult['error'] = 'No function arguments!'; }

if( !isset($aResult['error']) ) {

    switch($_GET['functionname']) {
        case 'get_winning_number':
            $data = get_winning_number($_GET['arguments']);
           
           break;

        default:
           $aResult['error'] = 'Not found function '.$_GET['functionname'].'!';
           break;
    }
    echo json_encode($data);

}


function get_winning_number($prize_id){ 
  
   
    include 'connection.php';

    try{
        if($prize_id == 1){
            $sql = 'SELECT * FROM lucky_numbers WHERE customer_id in (SELECT customer_id FROM all_customer_count WHERE customer_count=(SELECT MAX(customer_count) FROM all_customer_count))';
            $stmt = $conn->query($sql);
            $max_customer_count = array();
            while($rows = $stmt->fetchAll(PDO::FETCH_ASSOC)){
                $max_customer_count = $rows;
            }
            return $max_random_number = $max_customer_count[array_rand($max_customer_count)];
        }else{
            
            $sql = 'SELECT * FROM lucky_numbers WHERE customer_id NOT IN (SELECT customers.id FROM customer_prizes INNER JOIN lucky_numbers ON customer_prizes.lucky_number_id=lucky_numbers.id INNER JOIN customers ON customers.id=lucky_numbers.customer_id)';
            $min_query = $conn->query($sql);
            $min_customer_count = array();
            while($rows = $min_query->fetchAll(PDO::FETCH_ASSOC)){
                $min_customer_count = $rows;
            }
            return $min_random_number = $min_customer_count[array_rand($min_customer_count)];
        
        
    }
    }
    catch(Exception $e){
        echo "Error!:" . $e->getMessage() . "</br>";
        return array();
    }
 
}
?>
