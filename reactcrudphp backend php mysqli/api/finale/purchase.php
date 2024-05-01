<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

$servername = "localhost";
$username = "root";
$password = "";
$database = "reactphp";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $data = json_decode(file_get_contents('php://input'), true);
  $cart = $data['cart'];
  $refClient = uniqid('client_', true); // Générer une référence client unique

  foreach ($cart as $item) {
    $productId = $item['id'];
    $quantity = $item['quantity'];
    $buyerName = $item['buyerName']; 
    // Mettre à jour le stock dans la base de données
    $sql = "UPDATE tbl_product SET pstock = pstock - $quantity WHERE p_id = $productId";
    if ($conn->query($sql) !== TRUE) {
      echo "Error updating stock: " . $conn->error;
    }

    // Enregistrer l'achat dans la base de données avec le nom de l'acheteur et la référence client
    $sql = "INSERT INTO purchases (product_id, quantity, buyer_name, refclient) VALUES ($productId, $quantity, '$buyerName', '$refClient')";
    if ($conn->query($sql) !== TRUE) {
      echo "Error recording purchase: " . $conn->error;
    }
  }

  echo json_encode("Purchase confirmed. Invoice generated.");
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