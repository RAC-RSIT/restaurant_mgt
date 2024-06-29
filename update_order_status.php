<?php 

include('db_connection.php'); 

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $id = $_POST['id'];
        $status = $_POST['new_order_status'];  
        
        $sql = "UPDATE FOOD_ORDER SET status = :status WHERE id = :id";

        $statement = $conn->prepare($sql);
        
        $statement->bindParam(":id", $id);
        $statement->bindParam(":status", $status);
        $statement->execute();

        // go to dashboard.php
        header("Location: dashboard.php");
    }
    catch(Exception $e) {
        echo "error: " . $e->getMessage();
    }
}

