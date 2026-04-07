<?php
// backend/api/orders.php

// Règles CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

require_once 'db.php';

// GESTION D'AJOUT DE COMMANDE (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"));

    if($data && (isset($data->product) || isset($data->products)) && isset($data->phone)) {
        
        // Si on reçoit plusieurs produits (panier), on les transforme en chaîne JSON
        $products = isset($data->products) ? $data->products : $data->product;
        $productString = is_array($products) || is_object($products) ? json_encode($products) : htmlspecialchars(strip_tags($products));
        
        $name = htmlspecialchars(strip_tags($data->name));
        $phone = htmlspecialchars(strip_tags($data->phone));
        $address = htmlspecialchars(strip_tags($data->address));

        try {
            $stmt = $pdo->prepare("INSERT INTO orders (product, name, phone, address) VALUES (?, ?, ?, ?)");
            $stmt->execute([$productString, $name, $phone, $address]);
            
            http_response_code(201); // Créé
            echo json_encode(array(
                "statut" => "succes",
                "message" => "Commande enregistrée avec succès !",
                "orderId" => $pdo->lastInsertId()
            ));
        } catch (\PDOException $e) {
            http_response_code(500);
            echo json_encode(array("statut" => "erreur", "message" => "Erreur lors de l'enregistrement."));
        }

    } else {
        http_response_code(400);
        echo json_encode(array("statut" => "erreur", "message" => "Informations de commande manquantes."));
    }
} 
// GESTION DE RÉCUPÉRATION (GET)
else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        $stmt = $pdo->query("SELECT * FROM orders ORDER BY created_at DESC");
        $orders = $stmt->fetchAll();
        echo json_encode($orders);
    } catch (\PDOException $e) {
        http_response_code(500);
        echo json_encode(array("statut" => "erreur", "message" => "Erreur de base de données."));
    }
}
?>
