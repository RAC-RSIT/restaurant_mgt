<?php 

require 'db_connection.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $username = $_POST['username'];
        $password = $_POST['password']; 
    
        $sql = "SELECT * FROM USER WHERE username=:username"; 

        $statement = $conn->prepare($sql);
        $statement->bindParam(":username", $username);
        $statement->execute(); 

        $user = $statement->fetch(PDO::FETCH_ASSOC); 
        
        session_start(); 

        if($user) { // if the user is found 
            if(password_verify($password, $user['password'])) { // if input password matches the stored hash value 
                $_SESSION['user'] = $user;
                $_SESSION['username'] = $user['username']; 
                $_SESSION['user_role'] = $user['user_role'];
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['isLoggedIn'] = true; // keep this flag to check if the user is logged in
                header('Location: dashboard.php');
            }
            else { // password didn't match
                $_SESSION['flash_message'] = "Invalid username or password"; 
                header('Location: login.php');
            }
        } 
        else { // user not found, display error message
            $_SESSION['flash_message'] = "Invalid username or password"; 
            header('Location: login.php');
        }
    }
    catch(Exception $e) {
        // echo "error: " . $e->getMessage();
        $_SESSION['flash_message'] = "error: " . $e->getMessage();
        header('Location: login.php');
    }
}