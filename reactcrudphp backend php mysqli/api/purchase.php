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
if ($_SERVER["REQUEST_METHOD"] == "GET") {
  $sql = "SELECT refclient, GROUP_CONCAT(product_id) AS product_ids, GROUP_CONCAT(quantity) AS quantities, buyer_name FROM purchases GROUP BY refclient";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $purchases = array();
    while($row = $result->fetch_assoc()) {
      $purchase = array(
        "refclient" => $row["refclient"],
        "buyer_name" => $row["buyer_name"],
        "product_ids" => explode(",", $row["product_ids"]), // Convertir la chaîne en tableau
        "quantities" => explode(",", $row["quantities"]) // Convertir la chaîne en tableau
      );
      $purchases[] = $purchase;
    }
    echo json_encode($purchases);
  } else {
    echo "0 results";
  }
}

$conn->close();
?>