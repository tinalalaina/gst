<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$database = "ventereact";
// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "GET") {
  $sql = "SELECT id, name, price, stock FROM products";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $products = array();
    // Output data of each row
    while($row = $result->fetch_assoc()) {
      $products[] = $row;
    }
    header('Content-Type: application/json');
    echo json_encode($products);
  } else {
    echo "0 results";
  }
} elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Récupérer les données du panier envoyées depuis le frontend
  $data = json_decode(file_get_contents("php://input"), true);
  $cart = $data['cart'];

  // Parcourir le panier et mettre à jour le stock dans la base de données
  foreach ($cart as $item) {
    $productId = $item['id'];
    $quantity = $item['quantity'];
    $sql = "UPDATE products SET stock = stock - $quantity WHERE id = $productId";
    if ($conn->query($sql) !== TRUE) {
      echo "Error updating stock: " . $conn->error;
    }
  }
  // Envoyer une réponse pour confirmer que la mise à jour du stock a été effectuée
  echo json_encode("Stock updated successfully.");
}

$conn->close();
?>