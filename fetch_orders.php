<?php 
    include('db_connection.php'); 

    $sql = "SELECT * FROM FOOD_ORDER";
    $statement = $conn->prepare($sql); 
    $statement->execute(); 
    $orders = $statement->fetchAll(PDO::FETCH_ASSOC);  

    session_start();
    $username = $_SESSION['username'];
    $user_role = $_SESSION['user_role'];
?>

<?php include('header.php'); ?>
<?php include('navbar.php'); ?>

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
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php include('footer.php'); ?>