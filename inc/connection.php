
<?php
// $servername = "localhost";
// $username = "aungpyae_lucky_draw";
// $password = "luckydraw@1";

$servername = "localhost";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=aungpyae_lucky_draw", $username, $password);
    // set the PDO error mode to ex?c@j4Q3xtn*Mception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully!";
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
?>





