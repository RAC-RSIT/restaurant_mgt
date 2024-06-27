<?php 

include('db_connection.php'); 

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $id = $_POST['id']; 

    $sql = "DELETE FROM USER WHERE id = $id"; 

    $conn->exec($sql); 
}

// go to dashboard.php
header("Location: dashboard.php");