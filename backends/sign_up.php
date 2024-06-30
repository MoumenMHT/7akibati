<?php
if (isset($_POST['submit'])) {
    // Include the database connection
    include 'db_conection.php';
    
    // Get user inputs from the form
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Hash the password
    
    // Prepare and execute the SQL query to insert a new admin record
    $insertQuery = "INSERT INTO admin (username, password) VALUES ( ?, ?)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("ss", $username,  $password);
    
    if ($stmt->execute()) {
        // Successful sign-up
        
        // Retrieve the ID of the inserted admin
        $insertedId = $stmt->insert_id;
        
        // Close the statement and connection
        $stmt->close();
        $conn->close();
        
        // Redirect to the edit page with the inserted admin's ID
        header("Location: ../admin/index.php?id=$insertedId");
        exit();
    } else {
        // Failed sign-up
        echo "Error: " . $stmt->error;
    }
    
    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
