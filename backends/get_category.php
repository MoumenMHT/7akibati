<?php
include 'db_conection.php';  

$sql = "SELECT category_name FROM category;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data for each row
    while ($row = $result->fetch_assoc()) {
        echo '<div class="nav-item dropdown">';
        echo '<a href="category_products.php?category=' . urlencode($row["category_name"]) . '" class="nav-link">' . $row["category_name"] . ' </a>';
        echo '</div>';
    }
} else {
    echo "No categories found";
}

// Close the connection
$conn->close();
?>
