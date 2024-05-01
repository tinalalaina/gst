<?php
header("Content-Type: text/plain");

// Inclure la configuration de la base de données
include_once 'config.php';

// Récupérer les données de la requête POST
$data = json_decode(file_get_contents('php://input'), true);
$cart = $data['cart'];
$buyerName = $cart[0]['buyerName'];

// Générer le contenu de la facture
$invoiceContent = "Invoice for: $buyerName\n\n";
$invoiceContent .= "---------------------------------\n";
$invoiceContent .= "Item\t\t\tPrice\tQuantity\tTotal\n";
$invoiceContent .= "---------------------------------\n";

$totalAmount = 0;
foreach ($cart as $item) {
    $productName = $item['name'];
    $price = $item['price'];
    $quantity = $item['quantity'];
    $totalItemPrice = $price * $quantity;
    $totalAmount += $totalItemPrice;
    
    // Formatage des détails de l'article pour l'affichage
    $invoiceContent .= "$productName\t\t$$price\t$quantity\t\t$$totalItemPrice\n";
}

$invoiceContent .= "---------------------------------\n";
$invoiceContent .= "Total:\t\t\t\t\t$$totalAmount\n";
$invoiceContent .= "---------------------------------\n";

// Sauvegarder la facture dans un fichier
$filename = "invoices/invoice_$buyerName.txt";
$filePath = __DIR__ . "/" . $filename; // Chemin complet du fichier
if (!file_exists('invoices')) {
    mkdir('invoices', 0777, true); // Créer le répertoire s'il n'existe pas
}
if (file_put_contents($filePath, $invoiceContent) !== false) {
    echo json_encode("Invoice generated successfully. Download your invoice: $filename");
} else {
    echo json_encode("Error: Unable to generate invoice.");
}
?>