<?php
session_start();

if (isset($_GET['remove_id'])) {
    $remove_id = $_GET['remove_id'];
    $key = array_search($remove_id, $_SESSION['cart']);
    if ($key !== false) {
        unset($_SESSION['cart'][$key]);
    }
}

// Redirect back to the cart page
header("Location: ../market/cart.php");
exit();
?>
