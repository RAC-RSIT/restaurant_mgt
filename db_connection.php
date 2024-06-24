<?php 

try {
    $host = "localhost"; 
    $username = "root"; 
    $password = ""; 
    $db = "restaurant_mgt"; 

    $conn = new PDO("mysql:host=$host;dbname=$db", $username, $password);  
}

catch(PDOException $e) {
    echo "error: " . $e->getMessage(); 
}