<?php 

include('db_connection.php'); 
include('form_validation.php'); 

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // ***** read all input values ******
        $name = $_POST['name'];
        $size = $_POST['size']; 
        $price = $_POST['price']; 
        $stock = $_POST['stock'];
        $is_active = isset($_POST['is_active']) ? true : false;
        
        if( !is_item_unique() ) {
            session_start(); 
            $_SESSION['flash_message'] = "<h3 class='text-danger'>" . $name . " (" . $size . ") is not a unique item. It's already added</h3>";
        }
        elseif( !is_name_valid($name) ) { 
            session_start(); 
            $_SESSION['flash_message'] = "<h3 class='text-danger'>This name is not valid</h3>";
        }
        else {
            $sql = "INSERT INTO ITEM (name, size, price, stock, is_active) VALUES (:name, :size, :price, :stock, :is_active)"; 
            $statement = $conn->prepare($sql);
            $statement->bindParam(":name", $name);
            $statement->bindParam(":size", $size);
            $statement->bindParam(":price", $price);
            $statement->bindParam(":stock", $stock);
            $statement->bindParam(":is_active", $is_active);
            $statement->execute(); 

            session_start();
            $_SESSION['flash_message'] = "<h3 class='text-success'>successfully added " . $name . " (" . $size . ")</h3>";
        }

        // redirect to the same page after registering new user
        header('Location: add_item.php');

    }
    catch(Exception $e) {
        echo "error: " . $e->getMessage();
    }
}