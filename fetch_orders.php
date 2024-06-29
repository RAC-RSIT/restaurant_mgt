<?php 
    include('db_connection.php'); 

    $sql = "SELECT * FROM FOOD_ORDER";
    $statement = $conn->prepare($sql); 
    $statement->execute(); 
    $orders = $statement->fetchAll(PDO::FETCH_ASSOC);  
?>

<html>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body class="container">
        <h3>Orders <small>(order by ---)</small></h3>
        <table class="table table-hover table-bordered table-striped my-3 text-center">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Items</th>
                    <th>Total amount</th>
                    <th>Waiter ID</th>
                    <th>Table no</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    foreach ($orders as $order) { 
                ?>
                    <tr>
                        <td><?= $order['id'] ?></td>
                        <td><?= $order['items'] ?></td>
                        <td><?= $order['total_amount'] ?></td>
                        <td><?= $order['waiter_id'] ?></td>
                        <td><?= $order['table_no'] ?></td>
                        <td><?= $order['status'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </body>
</html>