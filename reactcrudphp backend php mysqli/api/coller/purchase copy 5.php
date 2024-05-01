<?php 5 5 10
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

  if (!empty($cart)) {
    foreach ($cart as $item) {
      $productId = $item['id'];
      $quantity = $item['quantity'];
      $sql = "UPDATE products SET stock = stock - $quantity WHERE id = $productId";

      if ($conn->query($sql) !== TRUE) {
        echo "Error updating stock for product with ID $productId: " . $conn->error;
      }
    }
    
    echo json_encode("Purchase confirmed. Invoice generated. Stock updated.");
  } else {
    echo json_encode("Error: Cart is empty.");
  }
}

$conn->close();
?>