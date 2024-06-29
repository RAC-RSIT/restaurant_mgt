<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-warning"> 
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Meet up</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-primary" href="#">username: <?= isset($username) ? $username : NULL ?></a> <!-- $username is set in the SESSION -->
                    </li>
                    <?php if(isset($_SESSION['user']) and $_SESSION['user']['user_role'] == 'admin') {  ?>
                        <li class="nav-item">
                            <a class="nav-link" href="register.php">Register user</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="add_item.php">Add item</a>
                        </li>
                    <?php } ?>
                    <?php if(isset($_SESSION['user']) and ($_SESSION['user']['user_role'] == 'admin' or $_SESSION['user']['user_role'] == 'manager')) {  ?>
                        <li class="nav-item">
                            <a class="nav-link" href="fetch_orders.php">Order history</a>
                        </li>
                    <?php } ?>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a> 
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</body>
</html>