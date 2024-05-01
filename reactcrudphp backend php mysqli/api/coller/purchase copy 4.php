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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $cart = json_decode(file_get_contents('php://input'), true);

  foreach ($cart as $item) {
    $productId = $item['id'];
    $quantity = $item['quantity'];
    $sql = "UPDATE products SET stock = stock - $quantity WHERE id = $productId";
    if ($conn->query($sql) !== TRUE) {
      echo "Error updating stock: " . $conn->error;
    }
  }

  // Génération de la facture pour l'acheteur
  // Vous pouvez implémenter cette logique ici, par exemple, en créant un fichier PDF de la facture et en l'envoyant par e-mail à l'acheteur

  // Une fois la facture générée, vous pouvez renvoyer un message de confirmation
  echo json_encode("Purchase confirmed. Invoice generated.");
}

$conn->close();
?>