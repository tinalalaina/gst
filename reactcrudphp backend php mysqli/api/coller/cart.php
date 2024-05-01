<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$database = "ventereact";

$conn = new mysqli($servername, $username, $password, $database);

// Vérification de la connexion
if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

// Endpoint pour ajouter un produit au panier
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    if (!isset($data['id'])) {
        echo json_encode(['error' => 'Missing product ID']);
        exit;
    }
    
    $productId = $data['id'];
    
    // Insérer le produit dans la table de panier avec son ID
    $sql = "INSERT INTO cart (product_id) VALUES ('$productId')";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(['message' => 'Product added to cart successfully']);
    } else {
        echo json_encode(['error' => 'Error adding product to cart: ' . $conn->error]);
    }
}

// Fermeture de la connexion
$conn->close();
?>