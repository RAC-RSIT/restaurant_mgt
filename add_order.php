<?php
    if(isset($_SESSION['flash_message'])) {
       $message = $_SESSION['flash_message'];
       unset($_SESSION['flash_message']);
       echo $message;
    } 

    include('db_connection.php'); 
    // *****fetch all items*****
    $sql = "SELECT * FROM ITEM ORDER BY name";
    $statement = $conn->prepare($sql); 
    $statement->execute(); 
    $items = $statement->fetchAll(PDO::FETCH_ASSOC);

    // *****fetch unique item names only*****
    $sql = "SELECT DISTINCT name FROM ITEM ORDER BY name";
    $statement = $conn->prepare($sql); 
    $statement->execute(); 
    $itemNames = $statement->fetchAll(PDO::FETCH_ASSOC);

    // *****fetch unique item sizes only*****
    $sql = "SELECT DISTINCT size FROM ITEM ORDER BY size";
    $statement = $conn->prepare($sql); 
    $statement->execute(); 
    $itemSizes = $statement->fetchAll(PDO::FETCH_ASSOC);
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
            <form id="orderForm" action="place_order.php" method="POST">
              <div class="row">
                <div class="form-group col-md-4">
                    <label for="item-name">Item:</label>
                    <select name="item-name" id="item-name" class="form-control">
                    <option value="">--- select ---</option>
                      <?php foreach($itemNames as $item) { ?>
                        <option value="<?= $item['name'] ?>"><?= $item['name'] ?></option>
                      <?php } ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="item-size">Size:</label>
                    <select name="item-size" id="item-size" class="form-control">
                      <option value="">--- select ---</option>
                      <?php foreach($itemSizes as $item) { ?>
                        <option value="<?= $item['size'] ?>"><?= $item['size'] ?></option>
                      <?php } ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="quantity">Quantity:</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" min="1" value="1">
                </div>   
              </div>
              <br>
              <div class="row">
                <div class="col-md-4">
                  <label for="table-no">Table no:</label>
                  <select name="table-no" id="table-no" class="form-control">
                    <?php for($i=1; $i<=10; $i++) { ?>
                      <option value="<?= $i ?>"><?= $i ?></option>
                    <?php } ?>  
                  </select>
                </div>
                <div class="col-md-4">
                  <label for="waiter-id">Waiter ID:</label>   
                  <input type="text" class="form-control" value="<?= $user_id ?>" disabled>
                  <!-- value of this hidden field was set on session start, when the user came from dashboard -->
                  <input type="hidden" class="form-control" id="waiter-id" name="waiter-id" value="<?= $user_id ?>">
                </div>
              </div>
              <br>
              <button type="button" id="addItem" class="btn btn-primary">Add Item</button>
              <br><br>
              <h5>Added items:</h5>
              <ul id="orderList"></ul>
              <br>
              <!-- value of this hidden field is set dynamically using js after submitting the form -->
              <input type="hidden" name="items" id="items" value="[empty]">
              <div class="row d-flex justify-content-center">
                <button type="submit" id="placeOrder" class="btn btn-success col-md-5">Place Order</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>   
  <script src="script.js"></script>                
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>