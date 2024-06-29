<?php 

include('db_connection.php'); 

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $id = $_POST['id'];
        $name = $_POST['name']; 
        $size = $_POST['size']; 
        $price = $_POST['price'];
        $stock = $_POST['stock']; 
        
        $sql = "UPDATE ITEM SET name = :name, size = :size, price = :price, stock = :stock WHERE id = :id";

        $statement = $conn->prepare($sql);
        
        $statement->bindParam(":id", $id);
        $statement->bindParam(":name", $name);
        $statement->bindParam(":size", $size);
        $statement->bindParam(":price", $price);
        $statement->bindParam(":stock", $stock);

        $statement->execute();

        // go to dashboard.php
        header("Location: dashboard.php");
    }
    catch(Exception $e) {
        echo "error: " . $e->getMessage();
    }
}

