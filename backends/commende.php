<?php
session_start(); // Start the session

include 'db_conection.php';

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get form data
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $mobile_no = $_POST['num'];
        $wilaya = $_POST['wilaya'];
        $address = $_POST['adress'];
        $number = $_POST['number'];
        $statut = "pending";

        // Prepare and execute SQL query for client insertion
        $client_sql = "INSERT INTO client (nom, prenom, tel, adress, wilaya)
                       VALUES ('$first_name', '$last_name', '$mobile_no', '$address', '$wilaya')";

        if ($conn->query($client_sql) === TRUE) {
            // Get the last inserted client ID
            $client_id = $conn->insert_id;

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
                                VALUES ('$client_id', '$product_id', '$number', '$productPrice', '$statut', '$currentDate')";

                if ($conn->query($commende_sql) === TRUE) {
                    $updateQuantitySql = "UPDATE Article SET quantite = quantite - $number WHERE id_produit = '$product_id'";
    
                    if ($conn->query($updateQuantitySql) === TRUE) {
                        $_SESSION['success_message'] = "You bought the product successfuly";
                        header("Location: ../market/detail.php?id=$product_id");
                        exit();
                    } else {
                        $_SESSION['success_message'] = "We found a problem please try again later";
                        header("Location: ../market/detail.php?id=$product_id");
                        exit();
                    }
                } else {
                    echo "Error: " . $commende_sql . "<br>" . $conn->error;
                }
            } else {
                echo "Error: Product not found";
            }
        } else {
            echo "Error: " . $client_sql . "<br>" . $conn->error;
        }

        // Close connection
        $conn->close();
    }
}
?>
