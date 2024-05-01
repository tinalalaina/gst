<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
header("Access-Control-Allow-Origin:* ");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

$db_conn= mysqli_connect("localhost","root", "", "reactphp");
if($db_conn===false)
{
  die("ERROR: Could Not Connect".mysqli_connect_error());
}
$data = json_decode(file_get_contents("php://input"), true);

// Retrieve necessary data from the database based on product ID
// Perform necessary calculations
$productId = $data['productId'];
$quantity = $data['quantity'];

// Example calculation: fetch price from database and calculate total
// This is just a placeholder, replace it with actual logic to fetch price from database
$pricePerUnit = 100; // Example price per unit fetched from database
$totalPrice = $pricePerUnit * $quantity;
                                           //$totalPrice = $quantity + $productId; //MON EXEMPLE
// Return the calculated price to React
echo json_encode(['price' => $totalPrice]);
?>