<?php 

include('db_connection.php'); 

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $id = $_POST['id'];  // get id from the hidden input  
        $sql = "SELECT * FROM USER WHERE id = :id";  // fetch the employee info to set default values in the form
        $statement = $conn->prepare($sql); 
        $statement->bindParam(':id', $id);
        $statement->execute(); 
        $employee = $statement->fetch(PDO::FETCH_ASSOC);  

        $username = $employee['username']; 
        $firstname = $employee['firstname']; 
        $lastname = $employee['lastname']; 
        $email = $employee['email'];
        $phone = $employee['phone']; 
        $designation = $employee['user_role'];
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
                <h4 class="mb-3 text-center">Update the employee information</h4>
                <form action="edit_employee_process.php" method="POST">
                    <input type="hidden" id="id" name="id" value="<?= $id ?>">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?= $username ?>" disabled>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstname" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="firstname" name="firstname" value="<?= $firstname ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastname" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" value="<?= $lastname ?>">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= $email ?>">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" id="phone" name="phone" value="<?= $phone ?>">
                    </div>
                    <div class="mb-3">
                        <label for="designation" class="form-label">Designation</label>
                        <input type="tel" class="form-control" id="designation" name="designation" value="<?= $designation ?>" disabled>
                    </div>
                    <div class="d-grid gap-2 mt-3">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>  
            </div>
        </section>  
    </body>
</html>