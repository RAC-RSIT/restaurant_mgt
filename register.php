<?php
    session_start();
    if(isset($_SESSION['flash_message'])) {
       $message = $_SESSION['flash_message'];
       unset($_SESSION['flash_message']);
       echo "<h3>" . $message . "</h3>";
    }

    if(!$_SESSION['isLoggedIn'] || $_SESSION['user_role']!=='admin') {
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
          <h3>Restaurant Management Registration</h3>
        </div>
        <div class="card-body">
          <form action="register_process.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="firstname" class="form-label">First Name</label>
                <input type="text" class="form-control" id="firstname" name="firstname" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="lastname" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lastname" name="lastname" required>
              </div>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
              <label for="phone" class="form-label">Phone Number</label>
              <input type="tel" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="mb-3">
              <label for="profile_pic" class="form-label">Profile Picture</label>
              <input type="file" class="form-control" id="profile_pic" name="profile_pic" required accept=".png,.jpg">
            </div>
            <div class="mb-3">
              <label for="designation" class="form-label">Designation</label>
              <select class="form-select" id="designation" name="designation" required>
                <option value="">-- Select --</option>
                <option value="manager">Manager</option>
                <option value="waiter">Waiter</option>
                <option value="chef">Chef</option>
              </select>
            </div>
            <div class="d-grid gap-2 mt-3">
              <button type="submit" class="btn btn-primary">Register</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include('footer.php'); ?>