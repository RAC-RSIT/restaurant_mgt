<?php 
    include('db_connection.php'); 

    $sql = "SELECT * FROM FOOD_ORDER WHERE status NOT IN ('completed', 'cancelled', 'due')";
    $statement = $conn->prepare($sql); 
    $statement->execute(); 
    $orders = $statement->fetchAll(PDO::FETCH_ASSOC);  
?>

<html>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body class="container">
        <h3>Orders</h3>
        <table class="table table-hover table-bordered table-striped my-3 text-center">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Items</th>
                    <th>Total amount</th>
                    <th>Waiter ID</th>
                    <th>Table no</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    foreach ($orders as $order) { 
                ?>
                    <tr>
                        <td><?= $order['id'] ?></td>
                        <?php 
                            $itemsJson = $order['items']; 
                            $items = json_decode($itemsJson, true);
                        ?>
                        <td>
                            <ol>
                                <?php foreach($items as $item) { ?>
                                    <li><?= $item[0] . " (" . $item[1] . ") " . "x" . $item[2]; ?></li>
                                <?php } ?>    
                            </ol>
                        </td>
                        <td><?= $order['total_amount'] ?></td>
                        <td><?= $order['waiter_id'] ?></td>
                        <td><?= $order['table_no'] ?></td>
                        <td><?= $order['status'] ?></td>
                        <td>
                            <form action="update_order_status.php" method="POST">
                                <!-- this hidden input field is used to pass the id of the clicked record when the form is submitted -->
                                <input type="hidden" name="id" value="<?= $order['id']; ?>"> 
                                <?php if($_SESSION['user']['user_role'] == 'waiter') { ?>
                                <select name="new_order_status" id="new_order_status_by_waiter" class="form-control">
                                    <option value="">--- select ---</option>
                                    <option value="order taken">Order taken</option>
                                    <option value="food served">Food served</option>
                                    <option value="finished eating">Finished eating</option>
                                </select>
                                <?php } elseif($_SESSION['user']['user_role'] == 'chef') { ?> 
                                <select name="new_order_status" id="new_order_status_by_chef" class="form-control">
                                    <option value="">--- select ---</option>
                                    <option value="30 mins">Within 30 minutes</option>
                                    <option value="30 mins plus">More than 30 minutes</option>
                                    <option value="ready">Ready</option>
                                </select> 
                                <?php } elseif($_SESSION['user']['user_role'] == 'manager') { ?> 
                                <select name="new_order_status" id="new_order_status_by_manager" class="form-control">
                                    <option value="">--- select ---</option>
                                    <option value="completed">Payment completed</option>
                                    <option value="due">Due</option>
                                    <option value="cancelled">Cancelled</option>
                                </select>
                                <?php } ?>
                                <input type="submit" class="btn btn-primary" name="update-order-status" value="Update">
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </body>
</html>