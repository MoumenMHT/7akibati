<?php
include 'db_conection.php';

// Query to calculate total pending orders
$query = "
    SELECT COUNT(*) AS row_count
    FROM commende
    WHERE statut = 'pending';
";

$result = $conn->query($query);

if ($result) {
    $row = $result->fetch_assoc();
    $totalPendingOrders = $row['row_count'];
    echo  $totalPendingOrders;
} else {
    echo "Error executing query: " . $conn->error;
}

// Close the connection
$conn->close();
?>
