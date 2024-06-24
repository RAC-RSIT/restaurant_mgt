<?php 

include('db_connection.php'); 

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $username = $_POST['username'];
        $password = $_POST['password']; 
        $firstname = $_POST['firstname']; 
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $user_role = $_POST['designation']; 
        $profile_pic = $_FILES['profile_pic'];

        // get information about the uploaded file
        $filename = $profile_pic['name']; 
        $tmp_name = $profile_pic['tmp_name'];

        // set the directory where the file will be uploaded
        $target_dir = "pictures/";
        $target_file = $target_dir . $filename; 

        // keep the uploaded file 
        move_uploaded_file($tmp_name, $target_file); 
    
        $sql = "INSERT INTO USER (username, password, firstname, lastname, email, phone, profile_pic, user_role) VALUES (:username, :password, :firstname, :lastname, :email, :phone, :profile_pic, :user_role)"; 

        $statement = $conn->prepare($sql);

        $statement->bindParam(":username", $username);
        $statement->bindParam(":password", $password);
        $statement->bindParam(":firstname", $firstname);
        $statement->bindParam(":lastname", $lastname);
        $statement->bindParam(":email", $email);
        $statement->bindParam(":phone", $phone);
        $statement->bindParam(":profile_pic", $target_file);
        $statement->bindParam(":user_role", $user_role);

        $statement->execute(); 
    }
    catch(Exception $e) {
        echo "error: " . $e->getMessage();
    }
}

// go to index.php
// header("Location: index.php");