<?php
session_start();

// Initialize the shopping cart session variable if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Function to add an item to the cart
function addToCart($product_id) {
    if (!in_array($product_id, $_SESSION['cart'])) {
        $_SESSION['cart'][] = $product_id;
    }
}

// Get product ID from URL
$product_id = isset($_GET['id']) ? $_GET['id'] : null;

// Example usage
if ($product_id !== null) {
    addToCart($product_id);
}
header("Location: ../market/detail.php?id=$product_id");
exit();
// Display cart contents
//echo "<h1>Cart Contents</h1>";

//if (!empty($_SESSION['cart'])) {
 //   echo "<ul>";
 //   foreach ($_SESSION['cart'] as $product_id) {
 //       echo "<li>Product ID: " . $product_id . "</li>";
   // }
    //echo "</ul>";
//} else {
 //   echo "<p>Your cart is empty.</p>";
//}

//echo "<p><a href=\"index.php\">Back to Shopping</a></p>";
?>
