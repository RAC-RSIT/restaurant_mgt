<?php 

include('db_connection.php'); 

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $id = $_POST['id'];  // get id from the hidden input  
        $sql = "SELECT * FROM ITEM WHERE id = :id";  // fetch the employee info to set default values in the form
        $statement = $conn->prepare($sql); 
        $statement->bindParam(':id', $id);
        $statement->execute(); 
        $item = $statement->fetch(PDO::FETCH_ASSOC);  

        $name = $item['name']; 
        $quantity = $item['quantity']; 
        $price = $item['price']; 
        $stock = $item['stock'];
    }
    catch(Exception $e) {
        echo "error: " . $e->getMessage();
    }
}

?>

<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body class="container">
        <section class="container my-5 d-flex justify-content-center">
            <div class="w-50 p-5 bg-light border rounded">
                <h4 class="mb-3 text-center">Update item information</h4>
                <form action="edit_item_process.php" method="POST">
                    <input type="hidden" id="id" name="id" value="<?= $id ?>">
                    <div class="mb-3">
                        <label for="name" class="form-label">Username</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= $name ?>">
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">quantity</label>
                        <input type="text" class="form-control" id="quantity" name="quantity" value="<?= $quantity ?>">
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" class="form-control" id="price" name="price" value="<?= $price ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="stock" class="form-label">Stock</label>
                            <input type="number" class="form-control" id="stock" name="stock" value="<?= $stock ?>">
                        </div>
                    </div>
                    <div class="d-grid gap-2 mt-3">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>  
            </div>
        </section>  
    </body>
</html>