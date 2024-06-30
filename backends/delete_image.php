<?php
// Include your database connection file
include 'db_conection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["image_url"])) {
        $image_url = $_POST["image_url"];

        // Delete the product image from the database table
        $deleteQuery = "DELETE FROM productimage WHERE image_url = '$image_url'";
        if ($conn->query($deleteQuery)) {
            echo "Image deleted successfully.";
        } else {
            echo "Error deleting image: " . $conn->error;
        }

        // Close the connection
        $conn->close();
    } else {
        echo "Missing 'image_url' parameter.";
    }
} else {
    echo "Invalid request method.";
}
?>
