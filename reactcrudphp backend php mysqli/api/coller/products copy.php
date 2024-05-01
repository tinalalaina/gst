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
$conn->close();

?>