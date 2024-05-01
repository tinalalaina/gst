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
// Récupérer les données du corps de la requête
$data = json_decode(file_get_contents("php://input"));

$name = $data->name;
$price = $data->price;

// Préparez et exécutez la requête SQL pour insérer le produit dans la base de données
$sql = "INSERT INTO products (name, price) VALUES ('$name', '$price')";

if ($conn->query($sql) === TRUE) {
 
} else {
  
}

$conn->close();
?>