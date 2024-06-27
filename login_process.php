<?php 

include('db_connection.php'); 

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
                header('Location: dashboard.php');
            }
            else { // password didn't match
                echo "Invalid username or password"; 
            }
        } 
        else { // user not found, display error message
            echo "Invalid username or password";
        }
    }
    catch(Exception $e) {
        echo "error: " . $e->getMessage();
    }
}