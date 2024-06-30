<?php
// Include your database connection file
include 'db_conection.php';

if (isset($_POST['projectId'])) {
    $projectId = $_POST['projectId'];

    // Delete the product from the Article table
    $deleteQuery = "DELETE FROM Article WHERE id_produit = '$projectId'";
    if ($conn->query($deleteQuery)) {
        echo "Product deleted successfully.";
    } else {
        echo "Error deleting product: " . $conn->error;
    }

    // Close the connection
    $conn->close();
}
?>
