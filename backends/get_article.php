<?php
include 'db_conection.php';

$query = "SELECT
a.id_produit,
a.nom_ar AS product_name,
a.prix AS product_price,
a.quantite AS product_quantity,
a.main_pic AS main_pic
FROM Article a
WHERE a.quantite > 0; ";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="col-lg-3 col-md-6 col-sm-12 pb-1">';
        echo '<div class="card product-item border-0 mb-4">';
            echo '<div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">';
                echo '<a href="detail.php?id=' . $row['id_produit'] . '"><img class="img-fluid w-100" style="width: 400px; height: 300px;" src="' . $row['main_pic'] . '" alt=""></a>';
            echo '</div>';
            echo '<div class="card-body border-left border-right text-center p-0 pt-4 pb-3">';
                echo '<h6 class="text-truncate mb-3">' . $row['product_name'] . '</h6>';
                echo '<div class="d-flex justify-content-center">';
                    echo '<h6>' . $row['product_price'] . ' DA</h6>';
                echo '</div>';
            echo '</div>';
            echo '<div class="card-footer d-flex justify-content-center align-items-center bg-light border">';
            echo '<a href="detail.php?id=' . $row['id_produit'] . '" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-mine mr-1"></i>View Detail</a>';
        echo '</div>';
        
        echo '</div>';
        echo '</div>';
    }
} else {
    echo 'No products found.';
}

$conn->close();
?>
