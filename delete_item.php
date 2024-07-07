<?php 

include('db_connection.php'); 

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $id = $_POST['id']; 
    $is_active = 0; // apply soft delete

    $sql = "UPDATE ITEM SET is_active = :is_active WHERE id = :id"; 
    $statement = $conn->prepare($sql);
    $statement->bindParam(":is_active", $is_active) ;
    $statement->bindParam(":id", $id) ;
    $statement->execute(); 
    
    session_start();
    $_SESSION['flash_message'] = "Item successfully deleted";
}

// go to dashboard.php
header("Location: dashboard.php");