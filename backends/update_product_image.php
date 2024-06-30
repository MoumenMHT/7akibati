<?php
include 'db_conection.php';

if (isset($_GET['id'])) {
    $id_produit = $_GET['id'];
    $mainPicPath = ""; // Initialize the variable

    if (!empty($_FILES['main_pic']['name'])) {
        $mainPicTargetDir = "../product_img/";
        $mainPicTargetFile = $mainPicTargetDir . basename($_FILES['main_pic']['name']);

        // Upload main product image
        if (move_uploaded_file($_FILES['main_pic']['tmp_name'], $mainPicTargetFile)) {
            $mainPicPath = "../product_img/" . $_FILES['main_pic']['name'];
        }
    }
    $path=$mainPicPath;
    echo $path;
    echo '<br>';
    echo $id_produit;
    echo '<br>';

    // Use prepared statement to prevent SQL injection
    $updateQuery = "UPDATE Article SET main_pic = ? WHERE id_produit = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("si", $path, $id_produit);

    if ($stmt->execute()) {
        echo "Main product image updated successfully";
        header("Location: ../admin/edit.php?id=$id_produit");
    exit();
    } else {
        echo "Error updating main product image: " . $stmt->error;
    }

    $stmt->close();
    
}

$conn->close();
?>
