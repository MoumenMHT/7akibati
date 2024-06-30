<?php
// Include your database connection file
include 'db_conection.php';

if (isset($_POST['id_commende']) && isset($_POST['nombre'])) {
    $id_commende = $_POST['id_commende'];
    $nombre = $_POST['nombre'];

    // Delete the product from the Article table
    $deleteQuery = "UPDATE commende SET statut = 'off' WHERE id_commende = '$id_commende'";
    if ($conn->query($deleteQuery)) {
        echo "Product deleted successfully.";

        // Update the nombre column in the article table
        $sql = "UPDATE article SET quantite = quantite + $nombre";
        if ($conn->query($sql)) {
            echo " Nombre updated successfully.";
        } else {
            echo "Error updating nombre: " . $conn->error;
        }
    } else {
        echo "Error deleting product: " . $conn->error;
    }

    // Close the connection
    $conn->close();
}
?>
