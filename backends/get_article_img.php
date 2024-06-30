<?php


  if (isset($_GET['id'])) {
            $edit_product_id = $_GET['id'];
        include 'db_conection.php';
      
        

        $sql = "SELECT main_pic
        FROM article 
        WHERE id_produit = '$edit_product_id'
        ";
        $result2 = $conn->query($sql);
        

        if ($result2) {
            if ($row = $result2->fetch_assoc()) {
                    echo '<div class="carousel-inner border">';

                        echo '<div class="carousel-item active" style="width: 500px; height: 400px;" >';
                            echo '<img class="w-100 h-100"  src="' . $row['main_pic'] . '" alt="Image">';
                        echo '</div>';
                        
                
            }
        }
        $sql2 = "SELECT image_url FROM productimage WHERE id_produit = '$edit_product_id'";
        $result2 = $conn->query($sql2);
    
        while ($row = $result2->fetch_assoc()) {
            echo '<div class="carousel-item" style="width: 500px; height: 400px;">';
            echo '<img class="w-100 h-100" src="' . $row['image_url'] . '" alt="Image">';
            echo '</div>';
        
        }
        echo '<a class="carousel-control-prev" href="#product-carousel" data-slide="prev">';
        echo '<i class="fa fa-2x fa-angle-left text-dark"></i>';
        echo '</a>';
        echo '<a class="carousel-control-next" href="#product-carousel" data-slide="next">';
        echo '<i class="fa fa-2x fa-angle-right text-dark"></i>';
        echo '</a>';
        echo '</div>';
        $conn->close();
    }
?>
