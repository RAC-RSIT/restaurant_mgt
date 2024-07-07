<?php
    session_start();
    if(isset($_SESSION['flash_message'])) {
       $message = $_SESSION['flash_message'];
       unset($_SESSION['flash_message']);
       echo $message;
    }

    if(!$_SESSION['isLoggedIn'] || $_SESSION['user_role']!='admin') {
      $_SESSION['flash_message'] = "403: unauthorized access request";
      //redirect to login page
      header('Location: login.php');
    }

    $username = $_SESSION['username'];
    $user_role = $_SESSION['user_role'];
?>

<?php include('header.php'); ?>
<?php include('navbar.php'); ?>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header text-center">
          <h3>Add new item</h3>
        </div>
        <div class="card-body">
          <form action="add_item_process.php" method="post">
              <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
              </div>
              <div class="mb-3">
                <label for="size" class="form-label">Size</label>
                <input type="text" class="form-control" id="size" name="size" required>
              </div>
              <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" class="form-control" id="price" name="price" min="0" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" class="form-control" id="stock" name="stock" min="0" required>
                </div>
              </div>
              <div>
                <input type="checkbox" id="is_active" name="is_active">
                <label for="is_active">Is active?</label>
              </div>
              <div class="d-grid gap-2 mt-3">
                  <button type="submit" class="btn btn-primary">Add</button>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include('footer.php'); ?>