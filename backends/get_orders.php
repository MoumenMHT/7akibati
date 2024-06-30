<?php 
include 'db_conection.php';

// Query to retrieve order information
$query = "
    SELECT
        c.id_commende,
        c.date,
        c.prix_totale,
        c.statut,
        c.nombre,
        cl.nom,
        cl.prenom,
        cl.tel,
        cl.adress,
        a.id_produit,
        a.nom_ar AS article_name,
        a.main_pic AS main_pic
    FROM commende c
    INNER JOIN Client cl ON c.id_client = cl.id_client
    INNER JOIN Article a ON c.id_produit = a.id_produit
    WHERE c.statut = 'pending'
    ORDER BY c.date DESC
";

$result = $conn->query($query);

while ($row = $result->fetch_assoc()) {
    $total_price = $row['prix_totale'] * $row['nombre']; // Calculate total price
    echo '<tr>';
    echo '<td><img src="' . $row['main_pic'] . '" alt="Main Product Image" width="100"></td>';
    echo '<td>' . $row['article_name'] . '</td>';
    echo '<td>' . $row['nombre'] . '</td>';
    echo '<td>' . $row['nom'] . ' ' . $row['prenom'] . '</td>';
    echo '<td>' . $row['adress'] . '</td>';
    echo '<td>' . $row['tel'] . '</td>';
    echo '<td>' . $row['statut'] . '</td>';
    echo '<td>' . $row['date'] . '</td>';
    echo '<td>' . $row['prix_totale'] . '</td>';
    echo '<td>$' . $total_price . '</td>'; // Display total price
    echo '<td><a class="btn btn-success m-2 done-btn" data-id="' . $row['id_commende'] . '" href="#">Done</a>';
    echo '<a class="btn btn-danger m-2 delete-btn" href="#" data-id="' . $row['id_commende'] . '" data-nombre="' . $row['nombre'] . '">Canceled</a>';
    echo '</td>';
    echo '</tr>';
}

// Close the connection
$conn->close();
?>
