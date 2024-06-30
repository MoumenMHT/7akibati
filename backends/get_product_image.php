<?php
  if (isset($_GET['id'])) {
            $edit_product_id = $_GET['id'];
        include 'db_conection.php';
      
        // Query to retrieve product pictures and additional pics
        $query = "SELECT id_produit, main_pic
                  FROM Article where id_produit='$edit_product_id'";
        $result = $conn->query($query);

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td><img src="' . $row['main_pic'] . '" alt="Product Image" width="100"></td>';
                echo '<td>Yes</td>'; 
                echo '<td>'. $row['main_pic'] .'</td>';
                echo '<td> ';
                echo '<form method="post" action="../backends/update_product_image.php?id=' . $row['id_produit'] .'" enctype="multipart/form-data">';
                echo '<div class="mb-3">';
                echo '<input class="form-control" type="file" name="main_pic" id="mainPic">';
                
                echo '<input class="btn btn-primary" type="submit" value="Change main pic">';
                echo '</div>';
                echo '</form>';

                echo '</td>';
                echo '</tr>';
            }
        }

        $sql = "SELECT image_url
                  FROM productimage where id_produit = '$edit_product_id'";
        $result2 = $conn->query($sql);
        

        if ($result2) {
            while ($row = $result2->fetch_assoc()) {
                echo '<tr>';
                echo '<td><img src="' . $row['image_url'] . '" alt="Product Image" width="100"></td>';
                echo '<td>No</td>'; 
                echo '<td>'. $row['image_url'] .'</td>'; 
                echo '<td><button class="btn btn-danger delete-pic-btn"  data-id="' . $row['image_url'] . '">Delete</button></td>';
                echo '</tr>';
            }
        }

        $conn->close();
    }
        ?>