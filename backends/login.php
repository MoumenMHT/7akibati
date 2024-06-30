<?php

if (isset($_POST['submit'])) {
    // Include the database connection
    include 'db_conection.php';
    // Get user inputs from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $lastProductID = $conn->insert_id;

        header("Location: ../admin/index.php?id=$lastProductID"); // Redirect to the dashboard page
    } 
    else {
        $error_message = "Invalid username or password.";
        session_start();
        $_SESSION['error_message'] = $error_message;
        header("Location: ../admin/signin.php"); // Redirect to the signin page
        exit();
    }
    
} 
?>
