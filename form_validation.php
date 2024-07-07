<?php 

    function is_username_unique() {
            
        include('db_connection.php');

        if(isset($_POST['username'])) {
            try {
                $username = $_POST['username']; 
                
                $sql = "SELECT * FROM USER WHERE USER.username = :username"; 
                
                $statement = $conn->prepare($sql); 
                $statement->bindParam(":username", $username); 
                $statement->execute();
                
                $user = $statement->fetchAll(PDO::FETCH_ASSOC);
                
                if($user) {
                    return false; // false means the username is already taken
                }
                else {
                    return true; // true means the username is unique 
                }
            }
            catch(Exception $e) {
                echo "error: " . $e->getMessage();
            }
        }
    }



    function is_email_unique() {
            
        include('db_connection.php');

        if(isset($_POST['email'])) {
            try {
                $email = $_POST['email']; 
                
                $sql = "SELECT * FROM USER WHERE USER.email = :email"; 
                
                $statement = $conn->prepare($sql); 
                $statement->bindParam(":email", $email); 
                $statement->execute();
                
                $user = $statement->fetchAll(PDO::FETCH_ASSOC);
                
                if($user) {
                    return false; // false means the email is already used
                }
                else {
                    return true; // true means the email is unique 
                }
            }
            catch(Exception $e) {
                echo "error: " . $e->getMessage();
            }
        }
    }

    function is_item_unique() {
            
        include('db_connection.php');

        if(isset($_POST['name']) && isset($_POST['size'])) {
            try {
                $name = $_POST['name']; 
                $size = $_POST['size']; 
                
                $sql = "SELECT * FROM ITEM WHERE ITEM.name = :name AND ITEM.size = :size"; 
                
                $statement = $conn->prepare($sql); 
                $statement->bindParam(":name", $name); 
                $statement->bindParam(":size", $size); 
                $statement->execute();
                
                $item = $statement->fetch(PDO::FETCH_ASSOC);
                
                if($item) {
                    return false; // false means the username is already taken
                }
                else {
                    return true; // true means the username is unique 
                }
            }
            catch(Exception $e) {
                echo "error: " . $e->getMessage();
            }
        }
    }

    
    function is_name_valid($name) {
        $pattern = '/^[a-zA-Z]+[a-zA-Z0-9\s]*$/';
        return preg_match($pattern, $name);
    }      


    function check_file_validity() {

        include('db_connection.php');

        $allowed_extensions = array('jpg', 'png');
        $max_file_size = 1048576; // 1MB
        
        if (isset($_FILES['profile_pic'])) {
          $errors = []; // array to store all errors
        
          // check for upload error
          if ($_FILES['profile_pic']['error'] !== 0) {
            $errors[] = "Error uploading file: " . $_FILES['profile_pic']['error'];
          }
        
          // validate extension
          $extension = strtolower(pathinfo($_FILES['profile_pic']['name'], PATHINFO_EXTENSION));
          if (!in_array($extension, $allowed_extensions)) {
            $errors[] = "Invalid file extension. Only " . implode(', ', $allowed_extensions) . " are allowed."; 
          }
        
          // validate file size
          if ($_FILES['profile_pic']['size'] > $max_file_size) {
            $errors[] = "File size exceeds limit. Maximum allowed size is " . $max_file_size . " bytes.";
          }

          return $errors; 
        
        }   
}
?>