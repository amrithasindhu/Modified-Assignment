<?php
require_once('dbcon.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $user_type = $_POST['user_type'];

    
    if ($password != $cpassword) {
        
        echo "<script> alert('Passwords do not match!');
        window.location.href ='index.php';
        </script>";
        exit();
    }

    try {
       
        $db = new Database(); 
        $conn = $db->connect();

    
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
        $query = $conn->prepare("SELECT * FROM form WHERE email = :email");
        $query->bindParam(':email', $email);
        $query->execute();

        if ($query->rowCount() > 0) {
            echo "Email already exists!";
            exit();
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

       
        $insert = $conn->prepare("INSERT INTO form (name, email, password, user_type) VALUES (:name, :email, :password, :user_type)");
        $insert->bindParam(':name', $name);
        $insert->bindParam(':email', $email);
        $insert->bindParam(':password', $hashed_password);
        $insert->bindParam(':user_type', $user_type);

        if ($insert->execute()) {
            echo "Registration successful!";
            header("Location: login.php");
            exit();
        } else {
            echo "Error during registration!";
        }
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
    <link rel="stylesheet" type="text/css" href="registerstyle.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
   
</head>
<body>

    <div class="registrationform">
      
        <h2>Register Now</h2>
        <form action="" method="POST">
            <div class="mb-3">
                <input type="text" class="form-control" name="name" placeholder="Enter your Name" required>
            </div>
            <div class="mb-3">
                <input type="email" class="form-control" name="email" placeholder="Enter your Email" required>
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" name="password" placeholder="Enter your password" required>
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" name="cpassword" placeholder="Confirm your password" required>
            </div>
            <div class="mb-3">
                <select name="user_type" class="form-select" required>
                    <option value="">Select User Type</option>
                    <option value="student">Student</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Register Now</button>
            <p>Already have an account? <a href="login.php">Login</a></p>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
