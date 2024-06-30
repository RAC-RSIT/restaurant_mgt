<?php
    if(isset($_SESSION['flash_message'])) {
       $message = $_SESSION['flash_message'];
       unset($_SESSION['flash_message']);
       echo $message;
    } 

    include('db_connection.php'); 
    $sql = "SELECT * FROM ITEM ORDER BY name";
    $statement = $conn->prepare($sql); 
    $statement->execute(); 
    $items = $statement->fetchAll(PDO::FETCH_ASSOC);
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
            <form id="orderForm">
              <div class="row">
                <div class="form-group col-md-6">
                    <label for="item">Item:</label>
                    <select name="item" id="item" class="form-control">
                      <option value="">--- select ---</option>
                      <?php foreach($items as $item) { ?>
                        <option value="<?= $item['name'] . " (" . $item['size'] . ")" ?>"><?= $item['name'] . " (" . $item['size'] . ") --- " . $item['price'] . " tk"  ?></option>
                      <?php } ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="quantity">Quantity:</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" min="1" required>
                </div>   
              </div>
              <br>
              <button type="button" id="addItem" class="btn btn-primary">Add Item</button>
              <br><br>
              <h5>Added items:</h5>
              <ul id="orderList"></ul>
              <br>
              <div class="form-group">
                <label for="total-amount">Total amount: </label>
                <label for=""><b>BDT. <span id='total-amount'>0</span></b></label>
              </div>
              <div class="row d-flex justify-content-center">
                <button type="submit" class="btn btn-success col-md-5">Place Order</button>
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