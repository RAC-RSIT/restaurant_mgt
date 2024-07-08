<?php 

    session_start(); 

    // show flash_message if there's any
    if(isset($_SESSION['flash_message'])) {
        $message = $_SESSION['flash_message'];
        unset($_SESSION['flash_message']);
        echo "<h3 class='text-success'>" . $message . "</h3>";
     }
    
    if(!$_SESSION['isLoggedIn']) {
        $_SESSION['flash_message'] = "403: unauthorized access request";
        //redirect to login page
        header('Location: login.php');
      }

    $user = $_SESSION['user']; // user was stored in this SESSION from login_process.php 
    $username = $_SESSION['username']; 
    $user_role = $_SESSION['user_role']; 
    $user_id = $_SESSION['user_id']; 
?>

<?php include('header.php'); ?>
<?php include('navbar.php'); ?>


<?php

// Employees list
if($user_role == 'admin' or $user_role == 'manager') 
include('fetch_employees.php');


// Items list
if($user_role == 'admin' or $user_role == 'manager') 
include('fetch_items.php');


// Add new order
if($user_role == 'waiter') 
include('add_order.php');


// Pending orders and add new order
if($user_role == 'waiter' or $user_role == 'chef' or $user_role == 'manager') 
include('fetch_pending_orders.php'); 

?>

<?php include('footer.php'); ?>