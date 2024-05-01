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
  $data = json_decode(file_get_contents('php://input'), true);
  $cart = $data['cart'];

  // Initialize total price
  $totalPrice = 0;

  foreach ($cart as $item) {
    $productId = $item['id'];
    $quantity = $item['quantity'];
    $buyerName = $item['buyerName'];

    // Update stock in the database
    $sql = "UPDATE products SET stock = stock - $quantity WHERE id = $productId";
    if ($conn->query($sql) !== TRUE) {
      echo "Error updating stock: " . $conn->error;
      exit();
    }

    // Calculate total price of the order
    $totalPrice += ($item['price'] * $quantity);

    // Record purchase in the database with buyer's name
    $sql = "INSERT INTO purchases (product_id, quantity, buyer_name) VALUES ($productId, $quantity, '$buyerName')";
    if ($conn->query($sql) !== TRUE) {
      echo "Error recording purchase: " . $conn->error;
      exit();
    }
  }

  // Record invoice in the database
  $sql = "INSERT INTO invoices (total_price) VALUES ($totalPrice)";
  if ($conn->query($sql) !== TRUE) {
    echo "Error recording invoice: " . $conn->error;
    exit();
  }

  echo json_encode("Purchase confirmed. Invoice generated.");
} elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
  // Retrieve all invoices
  $sql = "SELECT * FROM invoices";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $invoices = array();
    while ($row = $result->fetch_assoc()) {
      $invoices[] = $row;
    }
    header('Content-Type: application/json');
    echo json_encode($invoices);
  } else {
    echo "0 results";
  }
}

$conn->close();
?>