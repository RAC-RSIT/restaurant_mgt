<?php 
    include('db_connection.php'); 
    $manager = 'manager'; 
    $chef = 'chef'; 
    $waiter = 'waiter'; 
    $staff = ['manager', 'chef', 'waiter'];
    $sql = "SELECT * FROM USER WHERE user_role IN (:manager, :chef, :waiter) ORDER BY user_role";
    $statement = $conn->prepare($sql); 
    $statement->bindParam(':manager', $manager);
    $statement->bindParam(':chef', $chef);
    $statement->bindParam(':waiter', $waiter);
    $statement->execute(); 
    $employees = $statement->fetchAll(PDO::FETCH_ASSOC);  
?>

<html>
    <body class="container">
        <h3>Employees <small>(order by designation)</small></h3>
        <table class="table table-hover table-bordered table-striped my-3 text-center">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>First name</th>
                    <th>Last name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Designation</th>
                    <?php if($_SESSION['user']['user_role'] == 'admin') { ?>
                        <th colspan="2">Actions</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php 
                    foreach ($employees as $employee) { 
                ?>
                    <tr>
                        <td><?= $employee['id'] ?></td>
                        <td><?= $employee['username'] ?></td>
                        <td><?= $employee['firstname'] ?></td>
                        <td><?= $employee['lastname'] ?></td>
                        <td><?= $employee['email'] ?></td>
                        <td><?= $employee['phone'] ?></td> 
                        <td><?= $employee['user_role'] ?></td> 
                        <?php if($_SESSION['user']['user_role'] == 'admin') { ?>
                        <td>
                            <form action="edit_employee.php" method="POST">
                                <!-- this hidden input field is used to pass the id of the clicked record when the form is submitted -->
                                <input type="hidden" name="id" value="<?= $employee['id']; ?>"> 
                                <input type="submit" class="btn btn-warning" name="edit-employee" value="EDIT">
                            </form>
                        </td>
                        <td>
                            <form action="delete_employee.php" method="POST">
                                <!-- this hidden input field is used to pass the id of the clicked record when the form is submitted -->
                                <input type="hidden" name="id" value="<?= $employee['id']; ?>"> 
                                <input type="submit" class="btn btn-danger" name="fire-employee" value="FIRE">
                            </form>
                        </td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </body>
</html>