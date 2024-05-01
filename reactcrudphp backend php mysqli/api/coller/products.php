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

if ($_SERVER["REQUEST_METHOD"] === "GET") {
  $sql = "SELECT id, name, price, stock FROM products";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $products = array();
    while($row = $result->fetch_assoc()) {
      $products[] = $row;
    }
    header('Content-Type: application/json');
    echo json_encode($products);
  } else {
    echo "0 results";
  }
} else {
  http_response_code(405); // Méthode non autorisée
  echo json_encode("Method Not Allowed");
}

$conn->close();
?>