<?php

include 'db_conection.php';

$query = "
SELECT
a.id_produit,
a.nom_ar AS product_name,
a.prix AS product_price,
a.quantite AS product_quantity,
c.category_name AS category_name,
a.main_pic AS main_pic
FROM Article a
INNER JOIN category c ON a.id_category = c.id_category
ORDER BY a.id_produit DESC
";

$result = $conn->query($query);

while ($row = $result->fetch_assoc()) {
    $id_produit = $row['id_produit'];
    $_SESSION['edit_product_id'] = $id_produit;

    echo '<tr>';
    echo '<td>' . $row['id_produit'] . '</td>';
    echo '<td><img src="' . $row['main_pic'] . '" alt="Main Product Image" width="100"></td>';
    echo '<td>' . $row['product_name'] . '</td>';
    echo '<td>' . $row['product_price'] . ' DA</td>';
    echo '<td>' . $row['product_quantity'] . '</td>';
    echo '<td>' . $row['category_name'] . '</td>';
    echo '<td><a class="btn btn-primary " href="edit.php?id=' . $row['id_produit'] . '">Edit</a>';
    echo ' &nbsp;';
    echo '<a class="btn btn-danger delete-btn" href="#" data-id="' . $row['id_produit'] . '">Delete</a></td>';
    echo '</tr>';

}

$conn->close();
?>
