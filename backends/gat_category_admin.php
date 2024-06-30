<?php 

include 'db_conection.php';  

$sql= "select category_name from category;";

$result = $conn->query($sql);


    
if ($result->num_rows > 0) {
    // Output data for each row
    while ($row = $result->fetch_assoc()) {
        echo '<option>' . $row["category_name"] . ' </option>';
      }
} else {
    echo "No categories found";
}

// Close the connection
$conn->close();
?>







