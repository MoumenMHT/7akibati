<?php
session_start(); // Start the session

// Include your database connection file
include 'db_conection.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];

    $quantity = $_POST['quantity'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    echo "Length of description: " . strlen($description); // Debugging statement


    // Upload and insert main product image
    if (!empty($_FILES['main_pic']['name'])) {
        $mainPicTargetDir = "../product_img/";
        $mainPicTargetFile = $mainPicTargetDir . basename($_FILES['main_pic']['name']);

        // Upload main product image
        if (move_uploaded_file($_FILES['main_pic']['tmp_name'], $mainPicTargetFile)) {
            $mainPicPath = "../product_img/" . $_FILES['main_pic']['name'];
        }
    }

    $sql= "select id_category from category where category_name='$category'";
    $result = $conn->query($sql);

    if ($result) {
        $row = $result->fetch_assoc(); // Fetch the first row of the result
    
        if ($row) {
            $id_category = $row['id_category']; // Store the value in a variable
            // Now you can use $id_category for further processing
        } else {
            // No rows found
        }



    // Insert product data into Article table
    $insertProductQuery = "INSERT INTO Article (nom_ar, prix, description, main_pic, quantite, id_category) 
                        VALUES ('$name', '$price', '$description', '$mainPicPath', '$quantity', '$id_category')";
    if ($conn->query($insertProductQuery) === TRUE) {

        // Get the last inserted product ID
        $lastProductID = $conn->insert_id;

        // Upload and insert additional product images
        if (!empty($_FILES['images']['name'][0])) {
            foreach ($_FILES['images']['name'] as $key => $name) {
                $targetDir = "../product_img/";
                $targetFile = $targetDir . basename($name);

                // Upload additional product image
                if (move_uploaded_file($_FILES['images']['tmp_name'][$key], $targetFile)) {
                    $imagePath = "../product_img/" . $name;

                    // Insert additional product image path into ProductImage table
                    $insertImageQuery = "INSERT INTO productimage (id_produit, image_url) 
                                        VALUES ('$lastProductID', '$imagePath')";
                    $conn->query($insertImageQuery);

                    $_SESSION['success_message'] = "Profuct add succsesfuly";
                    header("Location: ../admin/add_product.php");
                    exit();
                }
            }
        }
    }else {
        $_SESSION['success_message'] = "We found a problem please try again latter";
        echo "Error: " . $insertProductQuery . "<br>" . $conn->error; // Debugging statement
        header("Location: ../admin/add_product.php");
        exit();
    }


    // Close the connection
    $conn->close();

    // Redirect back to the form or wherever you want
   
}}else {
    $_SESSION['success_message'] = "We found a problem please try again latter kmok";
        header("Location: ../admin/add_product.php");
        exit();

}
?>
