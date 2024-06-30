<?php
// Include your database connection file
include 'db_conection.php';

if (isset($_POST['id_commende'])) {
    $id_commende = $_POST['id_commende'];

    // Delete the product from the Article table
    $deleteQuery = "UPDATE  commende SET statut = 'soled' where id_commende='$id_commende'";
    if ($conn->query($deleteQuery)) {
        echo "Product deleted successfully.";
    } else {
        echo "Error deleting product: " . $conn->error;
    }

    // Close the connection
    $conn->close();
}
?>
