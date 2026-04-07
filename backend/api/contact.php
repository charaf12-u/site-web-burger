<?php
// backend/api/contact.php

// Règles CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

require_once 'db.php';

// Récupération des données The JSON body
$data = json_decode(file_get_contents("php://input"));

if($data && isset($data->email) && isset($data->message)) {
    
    $nom = htmlspecialchars(strip_tags($data->nom));
    $email = htmlspecialchars(strip_tags($data->email));
    $sujet = htmlspecialchars(strip_tags($data->sujet));
    $message = htmlspecialchars(strip_tags($data->message));

    try {
        $stmt = $pdo->prepare("INSERT INTO contacts (nom, email, sujet, message) VALUES (?, ?, ?, ?)");
        $stmt->execute([$nom, $email, $sujet, $message]);
        
        http_response_code(200);
        echo json_encode(array(
            "statut" => "succes",
            "message" => "Votre message a bien été envoyé. Nous vous répondrons bientôt !"
        ));
    } catch (\PDOException $e) {
        http_response_code(500);
        echo json_encode(array("statut" => "erreur", "message" => "Erreur lors de l'enregistrement du message."));
    }

} else {
    // Erreur de données
    http_response_code(400);
    echo json_encode(array("statut" => "erreur", "message" => "Données incomplètes."));
}
?>
