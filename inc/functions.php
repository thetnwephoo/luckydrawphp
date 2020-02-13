<?php


// get customer
function get_customer($id) {
    include 'connection.php';

    $sql = 'SELECT id, name, email, ph_no,remark,profile_image,pass FROM customers WHERE id = ?';

    try{
        $results = $conn->prepare($sql);
        $results->bindValue(1, $id, PDO::PARAM_INT);
        $results->execute();
    }
    catch(Exception $e){
        echo "Error!:" . $e->getMessage() . "
";
        return false;
    }
    return $results->fetch();
}

// adding new customers
function add_customer($name, $email, $ph_no, $id=null,$profile_image,$remark,$pass){
    // var_dump($profile_image);
    // exit;
    include 'connection.php';
    if($id) {
        $sql = 'UPDATE customers SET name = ? , email = ? , ph_no = ? ,profile_image = ?,remark = ?,pass = ?'
        . ' WHERE id = ?';

    }else{
        $sql = 'INSERT INTO customers(name, email ,ph_no,profile_image,remark,pass) VALUES(?,?,?,?,?,?)';
    }
    

    try{
        $results = $conn->prepare($sql);
        
        $results->bindValue(1, $name, PDO::PARAM_STR);
        $results->bindValue(2, $email, PDO::PARAM_STR);
        $results->bindValue(3, $ph_no, PDO::PARAM_STR);
        $results->bindValue(4, $profile_image, PDO::PARAM_STR);
        $results->bindValue(5, $remark, PDO::PARAM_STR);
        $results->bindValue(6, $pass, PDO::PARAM_STR);
        if($id){
            $results->bindValue(7, $id, PDO::PARAM_INT);
        }
        $results->execute();
    }
    catch(Exception $e){
        echo "Error!:" . $e->getMessage() . "<br>";
        return false;
    }
    return true;
}
// get Prize
function get_prize($id){
    include 'connection.php';

    $sql = 'SELECT id, prize_type FROM prizes WHERE id = ?';

    try{
        $results = $conn->prepare($sql);
        $results->bindValue(1, $id, PDO::PARAM_INT);
        $results->execute();
    }
    catch(Exception $e){
        echo "Error!:" . $e->getMessage() . "
";
        return false;
    }
    return $results->fetch();
}
// add prize
function add_prize($prize_type, $id=null){
    include 'connection.php';
    if($id) {
        $sql = 'UPDATE prizes SET prize_type = ? '
        . ' WHERE id = ?';

    }else{
        $sql = 'INSERT INTO prizes(prize_type) VALUES(?)';
    }
    

    try{
        $results = $conn->prepare($sql);
        $results->bindValue(1, $prize_type, PDO::PARAM_STR);
        if($id){
            $results->bindValue(2, $id, PDO::PARAM_INT);
        }
        $results->execute();
    }
    catch(Exception $e){
        echo "Error!:" . $e->getMessage() . "<br>";
        exit;
        return false;
    }
    return true;
}


// get all customer list
function get_customer_list(){
    
    include 'inc/connection.php';

    try{
        $sql = 'SELECT * FROM customers';
        $stmt = $conn->query($sql);
        $stmt->execute();
       
        // set the resulting array to associative
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }
    catch(Exception $e){
        echo "Error!:" . $e->getMessage() . "</br>";
        return array();
    }
}
  
// prize list
function get_prize_list(){
    
    include 'inc/connection.php';

    try{
        $sql = 'SELECT * FROM prizes';
        $stmt = $conn->query($sql);
        $stmt->execute();
       
        // set the resulting array to associative
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }
    catch(Exception $e){
        echo "Error!:" . $e->getMessage() . "</br>";
        return array();
    }
}
// get Prize
function get_lucky_number($id){
    include 'connection.php';

    $sql = 'SELECT lucky_numbers.id, lucky_numbers.lucky_number, customers.name as customer_name, customers.id as customer_id FROM lucky_numbers INNER JOIN customers ON lucky_numbers.customer_id=customers.id WHERE lucky_numbers.id = ?';

    try{
        $results = $conn->prepare($sql);
        $results->bindValue(1, $id, PDO::PARAM_INT);
        $results->execute();
    }
    catch(Exception $e){
        echo "Error!:" . $e->getMessage() . "
";
        return false;
    }
    return $results->fetch();
}
//lucky number list
function get_luckynumber_list(){
    
    include 'inc/connection.php';

    try{
        $sql = 'SELECT lucky_numbers.id,lucky_numbers.lucky_number,customers.name as customer_name FROM lucky_numbers INNER JOIN customers ON lucky_numbers.customer_id = customers.id';
        $stmt = $conn->query($sql);
        $stmt->execute();
       
        // set the resulting array to associative
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }
    catch(Exception $e){
        echo "Error!:" . $e->getMessage() . "</br>";
        return array();
    }
}
// add luckynumber
function add_luckynumber($lucky_number,$customer_id,$id=null){
    include 'connection.php';
    if($id) {
        $sql = 'UPDATE lucky_numbers SET lucky_number = ? , customer_id=?'
        . ' WHERE id = ?';

    }else{
        $sql = 'INSERT INTO lucky_numbers(lucky_number,customer_id) VALUES(?,?)';
    }
    

    try{
        $results = $conn->prepare($sql);
        $results->bindValue(1, $lucky_number, PDO::PARAM_INT);
        $results->bindValue(2, $customer_id, PDO::PARAM_INT);
        if($id){
            $results->bindValue(3, $id, PDO::PARAM_INT);
        }
        $results->execute();
    }
    catch(Exception $e){
        echo "Error!:" . $e->getMessage() . "<br>";
        return false;
    }
    return true;
}
// delete Customer
function delete_customer($id){

    include 'connection.php';
    $sql = ' DELETE customers.* , lucky_numbers.* FROM customers LEFT JOIN lucky_numbers ON customers.id= lucky_numbers.customer_id where customers.id = ?';
    

    try{
        $results = $conn->prepare($sql);
        $results->bindValue(1, $id, PDO::PARAM_INT);
        $results->execute();
    }
    catch(Exception $e){
        echo "Error!:" . $e->getMessage() . "<br>";
        return false;
    }
    return true;
}
// delete Prize
function delete_prize($id){
    include 'connection.php';

    $sql = ' DELETE FROM prizes WHERE id = ?';

    try{
        $results = $conn->prepare($sql);
        $results->bindValue(1, $id, PDO::PARAM_INT);
        $results->execute();
    }
    catch(Exception $e){
        echo "Error!:" . $e->getMessage() . "<br>";
        return false;
    }
    return true;
}
// delete Lucky Number
function delete_lucky_number($id){
    include 'connection.php';

    $sql = ' DELETE FROM lucky_numbers WHERE id = ?';

    try{
        $results = $conn->prepare($sql);
        $results->bindValue(1, $id, PDO::PARAM_INT);
        $results->execute();
    }
    catch(Exception $e){
        echo "Error!:" . $e->getMessage() . "<br>";
        return false;
    }
    return true;
}
// //Get Winning number

function get_winning_number($prize_id =1){
  
   
    include 'connection.php';

    try{
        if($prize_id == 1){
            // var_dump($prize_id);
            // exit;
            $sql = 'SELECT * FROM lucky_numbers WHERE customer_id in (SELECT customer_id FROM all_customer_count WHERE customer_count=(SELECT MAX(customer_count) FROM all_customer_count))';
            $stmt = $conn->query($sql);
            $max_customer_count = array();
            while($rows = $stmt->fetchAll(PDO::FETCH_ASSOC)){
                $max_customer_count = $rows;
            }
            return $max_random_number = $max_customer_count[array_rand($max_customer_count)];
        }else{
            // var_dump($prize_id);
            // exit; 
            $sql = 'SELECT * FROM lucky_numbers WHERE customer_id NOT IN (SELECT customer_id FROM lucky_numbers WHERE customer_id in (SELECT customer_id FROM all_customer_count WHERE customer_count=(SELECT MAX(customer_count) FROM all_customer_count)))';
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
// Add winning number
function add_winning_number($prize_id,$winning_number){
    include 'connection.php';

    $lucky_number='SELECT id FROM lucky_numbers WHERE lucky_number = ?';
    try{
        $winning_number_id = $conn->prepare($lucky_number);
        $winning_number_id->bindValue(1, $winning_number, PDO::PARAM_INT);
        $winning_number_id->execute();
        $aa = $winning_number_id->fetch();
        $lucky_number_id=(int)$aa[0];
    }
    
    catch(Exception $e){
        echo "Error!:" . $e->getMessage() . "<br>";
        exit;
        return false;
    }
    // var_dump($prize_id);
    // exit; 
    $sql = "INSERT INTO customer_prizes (prize_id, lucky_number_id)VALUES (?,?)";
    

    try{
        $results = $conn->prepare($sql);
        $results->bindValue(1, $prize_id, PDO::PARAM_INT);
        $results->bindValue(2, $lucky_number_id, PDO::PARAM_INT);
        $results->execute();
    }
    catch(Exception $e){
        echo "Error!:" . $e->getMessage() . "<br>";
        exit;
        return false;
    }
    return true;
}
//All customer prize list
function get_customer_prize_list(){
    
    include 'inc/connection.php';

    try{
        $sql = 'SELECT * FROM all_customer_prizes';
        $stmt = $conn->query($sql);
        $stmt->execute();
       
        // set the resulting array to associative
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }
    catch(Exception $e){
        echo "Error!:" . $e->getMessage() . "</br>";
        return array();
    }
}

// delete All Customer Prize
function delete_all_customer_prizes(){
    include 'connection.php';

    $sql = 'TRUNCATE TABLE customer_prizes';

    try{
        $results = $conn->query($sql);
        $results->execute();
    }
    catch(Exception $e){
        echo "Error!:" . $e->getMessage() . "<br>";
        return false;
    }
    return true;
}
// prize list for winning number
function get_prize_for_winning(){
    
    include 'inc/connection.php';

    try{
        $sql = 'SELECT * FROM prizes WHERE id NOT IN (SELECT id FROM customer_prizes)';
        $stmt = $conn->query($sql);
        $stmt->execute();
       
        // set the resulting array to associative
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }
    catch(Exception $e){
        echo "Error!:" . $e->getMessage() . "</br>";
        return array();
    }
}

// function goBack() {
//     header('location:customer_list.php');
//   }


  //Register Form 

function register($name, $email, $ph_no, $id=null,$profile_image,$remark,$pass){
    
    include 'connection.php';
    
    $sql = 'INSERT INTO users(name,email,ph_no,profile_image,remark,pass) VALUES(?,?,?,?,?,?)';
        
    try{
        $results = $conn->prepare($sql);
        
        $results->bindValue(1, $name, PDO::PARAM_STR);
        $results->bindValue(2, $email, PDO::PARAM_STR);
        $results->bindValue(3, $ph_no, PDO::PARAM_STR);
        $results->bindValue(4, $profile_image, PDO::PARAM_STR);
        $results->bindValue(5, $remark, PDO::PARAM_STR);
        $results->bindValue(6, $pass, PDO::PARAM_STR);
        if($id){
            $results->bindValue(7, $id, PDO::PARAM_INT);
        }
        $results->execute();
    }
    catch(Exception $e){
        // echo "Error!:" . $e->getMessage() . "<br>";
        // echo 'hello';
        // exit;
        return false;
    }
    return true;
}


//user login
function user_login($name,$pass) {
    
    include 'inc/connection.php';
   
    $sql = 'SELECT id,name,email FROM users WHERE name=? AND pass=?';
    try{
        $results = $conn->prepare($sql);
        $results->bindValue(1, $name, PDO::PARAM_STR);
        $results->bindValue(2, $pass, PDO::PARAM_STR);
        $results->execute();

    }
    catch(Exception $e){
        echo "Error!:" . $e->getMessage() . ""; 
        return false;
      
    }
  
   
    return $results->fetch();
}
?>



