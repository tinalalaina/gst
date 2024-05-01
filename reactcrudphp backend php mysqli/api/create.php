<?php

header('Content-Type: application/json');

// Connexion à la base de données
$mysqli = new mysqli("localhost","root", "", "reactphp");

// Vérifier la connexion
if ($mysqli->connect_errno) {
    echo json_encode(["error" => "Échec de la connexion à MySQL: " . $mysqli->connect_error]);
    exit();
}

// Endpoint pour créer un nouvel événement
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title']) && isset($_POST['start']) && isset($_POST['end'])) {
    $title = $_POST['title'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    
    $stmt = $mysqli->prepare("INSERT INTO events (title, start, end) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $title, $start, $end);
    
    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["error" => "Erreur lors de la création de l'événement"]);
    }
    exit();
}

// Endpoint pour récupérer tous les événements
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $result = $mysqli->query("SELECT * FROM events");
    $events = [];
    while ($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
    echo json_encode($events);
    exit();
}

// Fermer la connexion
$mysqli->close();
?>