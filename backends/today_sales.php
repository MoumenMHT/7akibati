<?php
include 'db_conection.php';

// Get the current date
$currentDate = date('Y-m-d');

// Query to calculate total sales amount for today
$query = "
SELECT
id_produit,
SUM(prix_totale * nombre) AS total_sales
FROM commende
WHERE DATE(date) = '$currentDate' AND statut = 'soled'
GROUP BY id_produit;
";

$result = $conn->query($query);

if ($result) {
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $totalSales = $row['total_sales'];
        echo   number_format($totalSales, 2)."DA";
    } else {
        echo "No sales for today.";
    }
} else {
    echo "Error executing query: " . $conn->error;
}

// Close the connection
$conn->close();
?>
