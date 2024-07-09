<?php 
    include('db_connection.php'); 
    $sql = "SELECT * FROM ITEM WHERE is_active=1 ORDER BY name";
    $statement = $conn->prepare($sql); 
    $statement->execute(); 
    $items = $statement->fetchAll(PDO::FETCH_ASSOC);  
?>


<h3>Items <small>(order by name)</small></h3>
<table class="table table-hover table-bordered table-striped my-3 text-center">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Size</th>
            <th>Price</th>
            <th>Stock</th>
            <?php if($_SESSION['user']['user_role'] == 'admin') { ?>
                <th colspan="2">Actions</th>
            <?php } ?>
        </tr>
    </thead>
    <tbody>
        <?php 
            foreach ($items as $item) { 
        ?>
            <tr>
                <td><?= $item['id'] ?></td>
                <td><?= $item['name'] ?></td>
                <td><?= $item['size'] ?></td>
                <td><?= $item['price'] ?></td>
                <td><?= $item['stock'] ?></td>
                <?php if($_SESSION['user']['user_role'] == 'admin') { ?>
                <td>
                    <form action="edit_item.php" method="POST">
                        <!-- this hidden input field is used to pass the id of the clicked record when the form is submitted -->
                        <input type="hidden" name="id" value="<?= $item['id']; ?>"> 
                        <input type="submit" class="btn btn-warning" name="edit-item" value="EDIT">
                    </form>
                </td>
                <td>
                    <form id="deleteItemForm<?= $item['id'] ?>" class="deleteItemForm" action="delete_item.php" method="POST">
                        <!-- this hidden input field is used to pass the id of the clicked record when the form is submitted -->
                        <input type="hidden" name="id" value="<?= $item['id']; ?>"> 
                        <button type="submit" id="deleteItemBtn<?= $item['id'] ?>" class="deleteItemBtn btn btn-danger"  name="delete-item">Delete</button>
                    </form>
                </td>
                <?php } ?>
            </tr>
        <?php } ?>
    </tbody>
</table>
