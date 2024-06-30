<?php
session_start(); // Start the session

include 'db_conection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data for client
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $mobile_no = $_POST['num'];
    $wilaya = $_POST['wilaya'];
    $address = $_POST['adress'];
    $statut = "pending";

    // Prepare and execute SQL query for client insertion
    $client_sql = "INSERT INTO client (nom, prenom, tel, adress, wilaya)
                   VALUES ('$first_name', '$last_name', '$mobile_no', '$address', '$wilaya')";

    if ($conn->query($client_sql) === TRUE) {
        // Get the last inserted client ID
        $client_id = $conn->insert_id;

        foreach ($_GET['product'] as $product_id => $quantity) {
            // Get the product price
            $query = "SELECT prix FROM Article WHERE id_produit = '$product_id'";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $productPrice = $row['prix'];

                // Get the current date
                $currentDate = date('Y-m-d');

                // Prepare and execute SQL query for commende insertion
                $commende_sql = "INSERT INTO commende (id_client, id_produit, nombre, prix_totale, statut, date)
                                VALUES ('$client_id', '$product_id', '$quantity', '$productPrice', '$statut', '$currentDate')";

                if ($conn->query($commende_sql) !== TRUE) {
                    echo "Error: " . $commende_sql . "<br>" . $conn->error;
                }
            } else {
                echo "Error: Product not found";
            }
        }
        $_SESSION['cart'] = array();


        header("Location: ../market/index.php");
        exit();
    } else {
        echo "Error: " . $client_sql . "<br>" . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>
