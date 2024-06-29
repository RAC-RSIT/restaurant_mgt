<?php
    if(isset($_SESSION['flash_message'])) {
       $message = $_SESSION['flash_message'];
       unset($_SESSION['flash_message']);
       echo $message;
    }

    include('db_connection.php'); 
    $waiter = 'waiter'; 
    $sql = "SELECT * FROM USER WHERE user_role = :waiter";
    $statement = $conn->prepare($sql); 
    $statement->bindParam(':waiter', $waiter);
    $statement->execute(); 
    $waiters = $statement->fetchAll(PDO::FETCH_ASSOC);   
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add order</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header text-center">
            <h3>Add new order</h3>
          </div>
          <div class="card-body">
            <form action="add_order_process.php" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Items</label>
                    <input type="text" class="form-control" id="items" name="items" required>
                </div>
                <div class="mb-3">
                    <label for="total-amount" class="form-label">Total amount</label>
                    <input type="number" class="form-control" id="total-amount" name="total-amount" required>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="waiter-id" class="form-label">Waiter ID</label>
                        <select name="waiter-id" id="waiter-id" class="form-control">
                            <option value="">--- select ---</option>
                            <?php foreach($waiters as $waiter) { ?>
                            <option value="<?= $waiter['id']; ?>"><?= $waiter['id'] . " (" . $waiter['firstname'] . " " . $waiter['lastname'] . ")"; ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="table-no" class="form-label">Table no</label>
                        <select name="table-no" id="table-no" class="form-control">
                            <option value="">--- select ---</option>
                            <?php for($i=1; $i<=10; $i++) { ?>
                            <option value="<?= $i; ?>"><?= $i; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <input type="hidden" id="status" name="status" value="order taken">
                <div class="d-grid gap-2 mt-3">
                    <button type="submit" class="btn btn-primary">Place order</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>