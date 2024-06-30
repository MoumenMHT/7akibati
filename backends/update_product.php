<?php
// Include your database connection file
include 'db_conection.php';

if (isset($_POST['submit'])) {
    if (isset($_GET['id'])) {
        $product_id = $_GET['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];

    $quantity = $_POST['quantity'];
    $category = $_POST['category'];
    $description = $_POST['description'];

  

    $sql= "select id_category from category where category_name='$category'";
    $result= $conn->query($sql);

    if ($result) {
        $row = $result->fetch_assoc(); // Fetch the first row of the result
    
        if ($row) {
            $id_category = $row['id_category']; // Store the value in a variable
            // Now you can use $id_category for further processing
        } else {
            // No rows found
        }



    // Insert product data into Article table
    $insertProductQuery = "UPDATE Article
    SET nom_ar = '$name',
        prix = '$price',
        description = '$description',
        quantite = '$quantity',
        id_category = '$id_category'
    WHERE id_produit = '$product_id';
    ";
    $conn->query($insertProductQuery);

    // Get the last inserted product ID
    $lastProductID = $conn->insert_id;

    // Upload and insert additional product images
    
    // Close the connection
    $conn->close();

    // Redirect back to the form or wherever you want
    header("Location: ../admin/edit.php?id=$product_id");
    exit();
}}else {
    echo "kmok";

}}
?>
