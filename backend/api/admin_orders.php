<?php
// backend/api/admin_orders.php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, PATCH, DELETE");

session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    http_response_code(401);
    echo json_encode(array("statut" => "erreur", "message" => "Non autorisé."));
    exit;
}

require_once 'db.php';

$method = $_SERVER['REQUEST_METHOD'];

switch($method) {
    case 'GET':
        $stmt = $pdo->query("SELECT * FROM orders ORDER BY created_at DESC");
        $orders = $stmt->fetchAll();
        echo json_encode($orders);
        break;

    case 'PATCH':
        $data = json_decode(file_get_contents("php://input"));
        if ($data && isset($data->id) && isset($data->status)) {
            $stmt = $pdo->prepare("UPDATE orders SET status = ? WHERE id = ?");
            if ($stmt->execute([$data->status, $data->id])) {
                echo json_encode(array("statut" => "succes", "message" => "Statut mis à jour."));
            } else {
                http_response_code(500);
                echo json_encode(array("statut" => "erreur", "message" => "Erreur de mise à jour."));
            }
        }
        break;

    case 'DELETE':
        if (isset($_GET['id'])) {
            $stmt = $pdo->prepare("DELETE FROM orders WHERE id = ?");
            if ($stmt->execute([$_GET['id']])) {
                echo json_encode(array("statut" => "succes", "message" => "Commande supprimée."));
            } else {
                http_response_code(500);
                echo json_encode(array("statut" => "erreur", "message" => "Erreur lors de la suppression."));
            }
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(array("statut" => "erreur", "message" => "Méthode non autorisée."));
        break;
}
