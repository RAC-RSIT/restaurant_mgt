<?php 

include('db_connection.php'); 
include('form_validation.php');

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // ***** read all input values ******
        $username = $_POST['username'];
        $password = $_POST['password']; 
        $firstname = $_POST['firstname']; 
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $user_role = $_POST['designation']; 
        $profile_pic = $_FILES['profile_pic'];
        $is_active = true;

        // ***** validation *****
        if( !is_username_unique() ) {
            session_start(); 
            $_SESSION['flash_message'] = "The username is already taken";
            header('Location: register.php');
            exit;
        }
        if( !is_email_unique() ) {
            session_start(); 
            $_SESSION['flash_message'] = "The email is already in use";
            header('Location: register.php');
            exit;
        }
        if( !is_name_valid($username) ) {
            session_start(); 
            $_SESSION['flash_message'] = "This username is not valid";
            header('Location: register.php');
            exit;
        }
        if( check_file_validity() ) {
            $errors = check_file_validity();
            foreach($errors as $err) {
                echo $err . "<br>";
            }
            exit;
        }

        // get information about the uploaded file
        $filename = $profile_pic['name']; 
        $tmp_name = $profile_pic['tmp_name'];

        // set the directory where the file will be uploaded
        $random_number = (string) rand(1000, 9999); 
        $target_dir = "pictures/";
        $target_file = $target_dir . $random_number . '_' . $filename; 

        // keep the uploaded file 
        move_uploaded_file($tmp_name, $target_file); 

        // hashing the password 
        $password = password_hash($password, PASSWORD_DEFAULT);
    
        $sql = "INSERT INTO USER (username, password, firstname, lastname, email, phone, profile_pic, user_role, is_active) VALUES (:username, :password, :firstname, :lastname, :email, :phone, :profile_pic, :user_role, :is_active)"; 

        $statement = $conn->prepare($sql);

        $statement->bindParam(":username", $username);
        $statement->bindParam(":password", $password);
        $statement->bindParam(":firstname", $firstname);
        $statement->bindParam(":lastname", $lastname);
        $statement->bindParam(":email", $email);
        $statement->bindParam(":phone", $phone);
        $statement->bindParam(":profile_pic", $target_file);
        $statement->bindParam(":user_role", $user_role);
        $statement->bindParam(":is_active", $is_active);

        $statement->execute(); 

        $username = $_SESSION['username'];
        $user_role = $_SESSION['user_role'];
        $_SESSION['flash_message'] = "User successfully registered";

        // redirect to dashboard after registering new user
        header('Location: dashboard.php');

    }
    catch(Exception $e) {
        echo "error: " . $e->getMessage();
    }
}