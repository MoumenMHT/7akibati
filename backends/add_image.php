<?php
include 'db_conection.php';

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Debug: Print the received product ID
    echo "Debug: Product ID received from URL: " . $product_id . "<br>";

    if (!empty($_FILES['main_pic']['name'])) {
        $mainPicTargetDir = "../product_img/";
        $mainPicTargetFile = $mainPicTargetDir . basename($_FILES['main_pic']['name']);

        // Debug: Print the target file path
        echo "Debug: Target File Path: " . $mainPicTargetFile . "<br>";

        // Upload main product image
        if (move_uploaded_file($_FILES['main_pic']['tmp_name'], $mainPicTargetFile)) {
            $mainPicPath = "../product_img/" . $_FILES['main_pic']['name'];

            // Debug: Print the mainPicPath after upload
            echo "Debug: Main Pic Path after upload: " . $mainPicPath . "<br>";

            // Insert the image URL into the database
            $sql = "INSERT INTO productimage (image_url, id_produit) VALUES ('$mainPicPath', '$product_id')";
            if ($conn->query($sql) === TRUE) {
                
            } else {
                echo "Error inserting image: " . $conn->error;
            }

            // Close the connection
            $conn->close();
            echo "Image inserted successfully";
                header("Location: ../admin/edit.php?id=$product_id");
                exit();
        }
    } else {
        echo "Debug: No image uploaded.<br>";
    }
} 
?>
