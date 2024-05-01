<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

$servername = "localhost";
$username = "root";
$password = "";
$database = "ventereact";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
////////////////
if ($_SERVER["REQUEST_METHOD"] == "GET") { // Si la méthode est GET
  $sql = "SELECT refclient, buyer_name FROM purchases GROUP BY refclient"; // Sélectionnez refclient et buyer_name en regroupant par refclient
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $purchases = array();
    while($row = $result->fetch_assoc()) {
      $purchase = array(
        "refclient" => $row["refclient"],
        "buyer_name" => $row["buyer_name"]
      );
      $purchases[] = $purchase;
    }
    echo json_encode($purchases);
  } else {
    echo "0 results";
  }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $data = json_decode(file_get_contents('php://input'), true);
  $cart = $data['cart'];

  foreach ($cart as $item) {
    $productId = $item['id'];
    $quantity = $item['quantity'];
    $buyerName = $item['buyerName']; // Ajout du nom de l'acheteur

    // Mettre à jour le stock dans la base de données
    $sql = "UPDATE products SET stock = stock - $quantity WHERE id = $productId";
    if ($conn->query($sql) !== TRUE) {
      echo "Error updating stock: " . $conn->error;
    }
/////$refclient = uniqid(); // ou bien uniqid('client_', true) pour préfixer avec 'client_'
$refclient = time();
    // Enregistrer l'achat dans la base de données avec le nom de l'acheteur
    $sql = "INSERT INTO purchases (product_id, quantity, buyer_name, refclient) VALUES ($productId, $quantity, '$buyerName', '$refclient')";
    if ($conn->query($sql) !== TRUE) {
      echo "Error recording purchase: " . $conn->error;
    }
    /* Enregistrer l'achat dans la base de données avec le nom de l'acheteur
    $sql = "INSERT INTO invoices (customer_id, quantity, buyer_name) VALUES ($productId, $quantity, '$buyerName')";
    if ($conn->query($sql) !== TRUE) {
      echo "Error recording purchase: " . $conn->error;
    }
    */
  }

  echo json_encode("Purchase confirmed. Invoice generated.");
}

$conn->close();
?>