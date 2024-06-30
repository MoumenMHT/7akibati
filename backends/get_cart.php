<?php


include 'db_conection.php';

// Check if there is data in the session
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    $product_ids = $_SESSION['cart'];

    // Query to fetch product information based on product IDs
    $sql = "SELECT * FROM article WHERE id_produit IN (" . implode(",", $product_ids) . ")";
    $result = $conn->query($sql);

    if ($result !== false && $result->num_rows > 0) {
        echo '<form id="checkout-form" method="post" action="checkout.php">';
    echo '    <div class="row px-xl-5">';
    echo '        <div class="col-lg-8 table-responsive mb-5">';
    echo '            <table class="table table-bordered text-center mb-0">';
    echo '                <thead class="bg-secondary text-dark">';
    echo '                    <tr>';
    echo '                        <th>Products</th>';
    echo '                        <th>Price</th>';
    echo '                        <th>Quantity</th>';
    echo '                        <th>Remove</th>';
    echo '                    </tr>';
    echo '                </thead>';
    echo '                <tbody class="align-middle">';

    while ($row = $result->fetch_assoc()) {
        $productPrice = $row['prix']; // Product price
        $productId = $row['id_produit']; // Product ID
        $quantity = 1; // Default quantity

        echo '<tr>';
        echo '    <td class="align-middle"><img src="'.$row['main_pic'].'" alt="" style="width: 50px;"> '.$row['nom_ar'].'</td>';
        echo '    <td class="align-middle">'.$productPrice.'</td>';
        echo '    <td class="align-middle">';
        echo '        <div class="input-group quantity mx-auto" style="width: 195px;">';
        echo '    <div class="input-group-btn">';
echo '        <button type="button" class="btn btn-primary btn-minus">';
echo '            <i class="fa fa-minus"></i>';
echo '        </button>';
echo '    </div>';
        echo '            <input type="number" name="quantity[' . $productId . ']" class="form-control form-control-sm bg-secondary text-center quantity-input" value="' . $quantity . '" min="1">';
        echo '    <div class="input-group-btn">';
echo '        <button type="button" class="btn btn-primary btn-plus">';
echo '            <i class="fa fa-plus"></i>';
echo '        </button>';
echo '    </div>';
        echo '        </div>';
        echo '    </td>';
        echo '    <td class="align-middle"><button type="button" class="btn btn-sm btn-danger remove-button" data-remove-id="' . $productId . '">Remove</button></td>';
        echo '</tr>';
    }

    echo '                </tbody>';
    echo '            </table>';
    echo '            <button type="button" id="buyNowButton" class="btn btn-block btn-primary my-3 py-3">Buy now</button>';
    echo '        </div>';
    echo '    </div>';
    echo '</form>';
    } else {
        echo "No products found.";
    }
} else {
    echo "No products in the cart.";
}

$conn->close();

?>
