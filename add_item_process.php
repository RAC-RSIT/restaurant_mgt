<?php 

include('db_connection.php'); 

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // ***** read all input values ******
        $name = $_POST['name'];
        $size = $_POST['size']; 
        $price = $_POST['price']; 
        $stock = $_POST['stock'];
    
        $sql = "INSERT INTO ITEM (name, size, price, stock) VALUES (:name, :size, :price, :stock)"; 

        $statement = $conn->prepare($sql);

        $statement->bindParam(":name", $name);
        $statement->bindParam(":size", $size);
        $statement->bindParam(":price", $price);
        $statement->bindParam(":stock", $stock);

        $statement->execute(); 

        session_start();
        $_SESSION['flash_message'] = "successfully added " . $name . " (" . $size . ")";

        // redirect to the same page after registering new user
        header('Location: add_item.php');

    }
    catch(Exception $e) {
        echo "error: " . $e->getMessage();
    }
}