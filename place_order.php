<?php 
    include('db_connection.php');
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        try {
            $itemsJson = $_POST['items'];
            $waiter_id = $_POST['waiter-id'];
            $table_no = (int) $_POST['table-no'];
            $status = "order taken";  // initially the status for each order is 'order taken'
            $items = json_decode($itemsJson);
            $total_amount = 0;
            foreach($items as $i) {
                $name = $i[0];
                $size = $i[1];
                $quantity = (int) $i[2];
                // ***get the price of the item***
                $sql = "SELECT * FROM ITEM WHERE (name = :name AND size = :size)";
                $statement = $conn->prepare($sql);
                $statement->bindParam(":name", $name);
                $statement->bindParam(":size", $size);
                $statement->execute(); 
                $item = $statement->fetch(PDO::FETCH_ASSOC); 
                $price = $item['price'];
                $total_amount += ($price * $quantity);
            }
            
            // ***insert new order record***
            $sql = "INSERT INTO FOOD_ORDER (items, total_amount, waiter_id, table_no, status) VALUES (:items, :total_amount, :waiter_id, :table_no, :status)"; 
            $statement = $conn->prepare($sql);
            $statement->bindParam(":items", $itemsJson);
            $statement->bindParam(":total_amount", $total_amount);
            $statement->bindParam(":waiter_id", $waiter_id);
            $statement->bindParam(":table_no", $table_no);
            $statement->bindParam(":status", $status);
            $statement->execute(); 

            // // go to dashboard.php
            header("Location: dashboard.php");
        }
        catch(Exception $e) {
            echo "error: " . $e->getMessage();
        }
    }
?>