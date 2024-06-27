<?php 

include('db_connection.php'); 

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $id = $_POST['id'];
        $firstname = $_POST['firstname']; 
        $lastname = $_POST['lastname']; 
        $email = $_POST['email'];
        $phone = $_POST['phone']; 
        
        $sql = "UPDATE USER SET firstname = :firstname, lastname = :lastname, email = :email, phone = :phone WHERE id = :id";

        $statement = $conn->prepare($sql);
        
        $statement->bindParam(":id", $id);
        $statement->bindParam(":firstname", $firstname);
        $statement->bindParam(":lastname", $lastname);
        $statement->bindParam(":email", $email);
        $statement->bindParam(":phone", $phone);

        $statement->execute();

        // go to dashboard.php
        header("Location: dashboard.php");
    }
    catch(Exception $e) {
        echo "error: " . $e->getMessage();
    }
}

