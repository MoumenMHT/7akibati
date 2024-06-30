<?php


if (isset($_GET['id'])) {
    $edit_product_id = $_GET['id'];

    include 'db_conection.php';

    $query = "SELECT * FROM Article WHERE id_produit = $edit_product_id";
    $result = $conn->query($query);
    
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
        echo '<div class="form-floating mb-3">';
        echo '<input type="text" class="form-control" name="name" placeholder="Name" value="' . $product['nom_ar'] . '">';
        echo '<label for="floatingPassword">Product name</label>';
        echo '</div>';
    
        echo '<div class="form-floating mb-3">';
        echo '<input type="number" class="form-control" name="price" placeholder="Price" value="' . $product['prix'] . '">';
        echo '<label for="floatingPassword">Price</label>';
        echo '</div>';
    
        echo '<div class="form-floating mb-3">';
        echo '<input type="number" class="form-control" name="quantity" placeholder="Quantity" value="' . $product['quantite'] . '">';
        echo '<label for="floatingPassword">Quantity</label>';
        echo '</div>';
    
        echo '<div class="form-floating mb-3">';
        echo '<select class="form-select" name="category" aria-label="Select category">';

        $sql= "select category_name from category;";

            $result = $conn->query($sql);

            $sql2= "SELECT c.category_name AS category
            FROM Article a
            INNER JOIN category c ON a.id_category = c.id_category
            WHERE a.id_produit = $edit_product_id;";
            $result2 = $conn->query($sql2);

            if ($result2->num_rows > 0) {
                $row = $result2->fetch_assoc();
                $category = $row['category'];
            
                // Now you can use $category_name as needed
            } else {
                echo "Product not found.";
            }

                
            


            echo '<option selected>' . $category . '</option>';
            if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                echo '<option>' . $row["category_name"] . ' </option>';
            }
        } else {
            echo "No categories found";
        }
        // Include the code to fetch and display categories
        echo '</select>';
        echo '<label for="floatingSelect">Select category</label>';
        echo '</div>';
    
        echo '<div class="form-floating">';
        echo '<textarea class="form-control" name="description" placeholder="Leave a comment here" style="height: 150px;">' . $product['description'] . '</textarea>';
        echo '<label for="floatingTextarea">Description</label>';
        echo '</div>';
    
        
        echo '<button class="btn btn-outline-primary w-100 m-2" type="submit" name="submit">Update</button>';

        
    } else {
        echo 'Product not found.';
    }
    
   
    
    $conn->close();
} 


?>
