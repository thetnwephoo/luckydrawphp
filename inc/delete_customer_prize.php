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