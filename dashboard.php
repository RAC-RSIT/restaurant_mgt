<?php 

    session_start();    
    
    $user = $_SESSION['user']; // user was stored in this SESSION from login_process.php 
    $username = $user['username']; 
    $user_role = $user['user_role']; 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Dashboard</title>
</head>
<body>
    <?php include('navbar.php') ?> 

    <!-- Employees list -->
    <?php if($user_role == 'admin' or $user_role == 'manager') 
        include('fetch_employees.php');
    ?>


</body>
</html>