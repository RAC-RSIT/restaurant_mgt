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

        if ($user) { // user is not null 
            if(password_verify($password, $user['password'])) { // if input password matches the stored hash value
                header('location: dashboard.php');
            }
            else { // password didn't match, display error message 
                echo "Wrong Password, Please try again";
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