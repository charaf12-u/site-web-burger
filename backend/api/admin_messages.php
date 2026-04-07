<?php
// backend/api/admin_messages.php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, DELETE");

session_start();
// Vérification stricte si l'admin est connecté
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    http_response_code(401);
    echo json_encode(["statut" => "erreur", "message" => "Non autorisé."]);
    exit;
}

require_once 'db.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $stmt = $pdo->query("SELECT * FROM contacts ORDER BY created_at DESC");
        $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($messages);
        break;

    case 'DELETE':
        if (isset($_GET['id'])) {
            $stmt = $pdo->prepare("DELETE FROM contacts WHERE id = ?");
            if ($stmt->execute([$_GET['id']])) {
                echo json_encode(["statut" => "succes", "message" => "Message supprimé."]);
            } else {
                http_response_code(500);
                echo json_encode(["statut" => "erreur", "message" => "Erreur lors de la suppression."]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["statut" => "erreur", "message" => "ID manquant."]);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(["statut" => "erreur", "message" => "Méthode non autorisée."]);
        break;
}
